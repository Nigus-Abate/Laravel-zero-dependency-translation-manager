<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;

class AddNewLanguage extends Command
{
    // protected $signature = 'lang:copy {lang}';
    // protected $description = 'Copy default English language files to a new language directory';

    protected $signature = 'lang:copy {lang} {flag_icon}';
    protected $description = 'Copy default English language files to a new language directory and update the configuration with a custom flag icon';
 public function handle()
    {
        $lang = $this->argument('lang');
        $flagIcon = $this->argument('flag_icon');
        $defaultLangPath = resource_path('lang/en');
        $newLangPath = resource_path("lang/{$lang}");
        $configPath = config_path('panel.php');
        if (!File::exists($defaultLangPath)) {
            $this->error("Default language files not found.");
            return;
        }
        if (File::exists($newLangPath)) {
            $this->error("Language files for {$lang} already exist.");
            return;
        }
        File::copyDirectory($defaultLangPath, $newLangPath);
        // Update the config/panels.php file
        $config = include $configPath;
        // Add new language to the available_languages array
        $config['available_languages'][$lang] = [
            'name' => ucfirst($lang), // You can customize this as needed
            'flag' => $flagIcon,
        ];

        // Save updated config file
        File::put($configPath, '<?php return ' . var_export($config, true) . ';');

        $this->info("Language files for {$lang} copied and configuration updated successfully.");
    }
    public function handle1()
    {
        $lang = $this->argument('lang');
        $defaultLangPath = resource_path('lang/en');
        $newLangPath = resource_path("lang/{$lang}");

        if (!File::exists($defaultLangPath)) {
            $this->error("Default language files not found.");
            return;
        }

        if (File::exists($newLangPath)) {
            $this->error("Language files for {$lang} already exist.");
            return;
        }

        File::copyDirectory($defaultLangPath, $newLangPath);
        $this->info("Language files for {$lang} copied successfully.");
    }

}
