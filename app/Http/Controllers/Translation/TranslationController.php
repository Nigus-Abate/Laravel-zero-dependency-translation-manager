<?php
namespace App\Http\Controllers\Translation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class TranslationController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('locale_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $languages = array_filter(glob(resource_path('lang/*')), 'is_dir');
        $languages = array_map(fn($path) => basename($path), $languages);

        return view('admin.translations.index', [
            "navigation" => "settings",
            "sub_navigation" => "settings_locale",
            "page_subtitle" => "Locale",
            "languages" => $languages,
        ]);
    }
// without json
    public function edit1($lang)
    {
        abort_if(Gate::denies('locale_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $langPath = resource_path("lang/{$lang}");

        if (!File::exists($langPath)) {
            abort(404);
        }

        $translations = [];
        foreach (File::allFiles($langPath) as $file) {
            $translations[$file->getFilename()] = include $file->getPathname();
        }

        return view('admin.translations.manage', [
            "navigation" => "settings",
            "sub_navigation" => "settings_locale",
            "page_subtitle" => "Locale",
            "lang" => $lang,
            "translations" => $translations,
        ]);
    }
// with json
    public function edit($lang)
{
    abort_if(Gate::denies('locale_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    $langPath = resource_path("lang/{$lang}");

    if (!File::exists($langPath)) {
        abort(404);
    }

    $translations = [];
    foreach (File::allFiles($langPath) as $file) {
        $extension = $file->getExtension();
        $filename = $file->getFilename();

        if ($extension === 'php') {
            $translations[$filename] = include $file->getPathname();
        } elseif ($extension === 'json') {
            $translations[$filename] = json_decode(File::get($file->getPathname()), true);
        }
    }

    return view('admin.translations.manage', [
        "navigation" => "settings",
        "sub_navigation" => "settings_locale",
        "page_subtitle" => "Locale",
        "lang" => $lang,
        "translations" => $translations,
    ]);
}


    public function update(Request $request, $lang)
    {
        abort_if(Gate::denies('locale_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $translations = $request->except('_token');

        foreach ($translations as $file => $data) {
            $filePath = resource_path("lang/{$lang}/{$file}");
            if (is_array($data)) {
                $formattedData = $this->arrayToStringKeys($data);
                File::put($filePath, '<?php return ' . var_export($formattedData, true) . ';');
            } else {
                File::put($filePath, '<?php return ' . var_export([$data], true) . ';');
            }
        }

        return redirect()->route('translations.edit', $lang)->with('success', 'Translations updated successfully.');
    }

    public function editKey($lang, $file, $key)
    {
        abort_if(Gate::denies('locale_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $filePath = resource_path("lang/{$lang}/{$file}");

        if (!File::exists($filePath)) {
            abort(404);
        }

        $translations = include $filePath;

        $keys = explode('.', $key);
        $value = $translations;
        foreach ($keys as $part) {
            if (!isset($value[$part])) {
                abort(404);
            }
            $value = $value[$part];
        }

        return view('admin.translations.edit-key', [
            "navigation" => "settings",
            "sub_navigation" => "settings_locale",
            "page_subtitle" => "Locale",
            "lang" => $lang,
            "file" => $file,
            "key" => $key,
            "value" => $value,
        ]);
    }


    public function updateKey(Request $request, $lang, $file, $key)
    {
        abort_if(Gate::denies('locale_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $filePath = resource_path("lang/{$lang}/{$file}");

        if (!File::exists($filePath)) {
            abort(404);
        }

        $translations = include $filePath;

        $keys = explode('.', $key);
        $value = &$translations;
        foreach ($keys as $part) {
            $value = &$value[$part];
        }

        $value = $request->input('value');
        $content = $this->generatePhpArrayString($translations);

        File::put($filePath, $content);

        return redirect()->route('translations.edit', $lang)->with('success', 'Translation key updated successfully.');
    }

    private function arrayToStringKeys($array)
    {
        $result = [];
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    $result[$key] = $this->arrayToStringKeys($value);
                } else {
                    $result[$key] = $value;
                }
            }
        }
        return $result;
    }

    private function generatePhpArrayString($array)
    {
        $content = "<?php\n\nreturn [\n";
        $content .= $this->arrayToPhpString($array, 1);
        $content .= "];\n";
        return $content;
    }

    private function arrayToPhpString($array, $level = 1)
    {
        $indent = str_repeat('    ', $level);
        $output = '';

        foreach ($array as $key => $value) {
            $output .= $indent . "'" . addslashes($key) . "' => ";

            if (is_array($value)) {
                $output .= "[\n" . $this->arrayToPhpString($value, $level + 1) . $indent . "],\n";
            } else {
                $output .= "'" . addslashes($value) . "',\n";
            }
        }

        return $output;
    }

    public function addKey(Request $request, $lang)
{
    abort_if(Gate::denies('locale_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    $key = $request->input('key');
    $value = $request->input('value');

    $files = File::files(resource_path("lang/{$lang}"));
    if (empty($files)) {
        return redirect()->back()->with('error', 'No translation files found for the selected language.');
    }

    // Assume you want to add the key to all files
    foreach ($files as $file) {
        $filePath = $file->getPathname();
        $translations = include $filePath;

        // Split nested keys
        $keys = explode('.', $key);
        $valueRef = &$translations;
        foreach ($keys as $part) {
            if (!isset($valueRef[$part])) {
                $valueRef[$part] = [];
            }
            $valueRef = &$valueRef[$part];
        }
        $valueRef = $value;

        $content = $this->generatePhpArrayString($translations);
        File::put($filePath, $content);
    }

    return redirect()->route('translations.edit', $lang)->with('success', 'Translation key added successfully.');
}

public function copy(Request $request)
{
    abort_if(Gate::denies('locale_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    $newLang = $request->input('lang');
    $existingLangs = array_map(fn($path) => basename($path), glob(resource_path('lang/*')));

    if (in_array($newLang, $existingLangs)) {
        return redirect()->back()->with('error', 'Language already exists.');
    }

    // Copy translations from default language (e.g., 'en')
    $sourceLang = 'en'; // Default language to copy from
    $sourcePath = resource_path("lang/{$sourceLang}");
    $destinationPath = resource_path("lang/{$newLang}");

    File::copyDirectory($sourcePath, $destinationPath);

    return redirect()->route('translations.index')->with('success', 'New language added successfully.');
}

}
