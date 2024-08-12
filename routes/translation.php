<?php
use Illuminate\Http\Request;
use App\Http\Controllers\Translation\TranslationController;
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa']], function () {

// Route::prefix('super-admin')->group(function () {
	Route::get('translations', [TranslationController::class, 'index'])->name('translations.index');
	Route::get('translations/{lang}/edit', [TranslationController::class, 'edit'])->name('translations.edit');
	Route::post('translations/{lang}/edit', [TranslationController::class, 'update'])->name('translations.update');
	Route::get('translations/{lang}/{file}/{key}/edit', [TranslationController::class, 'editKey'])->name('translations.editKey');
	Route::post('translations/{lang}/{file}/{key}/edit', [TranslationController::class, 'updateKey'])->name('translations.updateKey');

Route::post('translations/copy', function (Request $request) {
    $lang = $request->input('lang');
    $flagIcon = $request->input('flag_icon');
    Artisan::call('lang:copy', [
        'lang' => $lang,
        'flag_icon' => $flagIcon
    ]);
    return redirect()->route('translations.index');
})->name('translations.copy');

	// Route to add a new key to the translations (from the modal)
Route::post('translations/add-key/{lang}', [TranslationController::class, 'addKey'])->name('translations.addKey');
// Route::post('translations/copy', [TranslationController::class, 'copy'])->name('translations.copy');

});


// // Route to list all languages
// Route::get('translations', [TranslationController::class, 'index'])->name('translations.index');

// // Route to edit translations for a specific language
// Route::get('translations/edit/{lang}', [TranslationController::class, 'edit'])->name('translations.edit');

// // Route to update translations for a specific language
// Route::post('translations/update/{lang}', [TranslationController::class, 'update'])->name('translations.update');

// // Route to edit a specific translation key
// Route::get('translations/edit-key/{lang}/{file}/{key}', [TranslationController::class, 'editKey'])->name('translations.editKey');

// // Route to update a specific translation key
// Route::post('translations/update-key/{lang}/{file}/{key}', [TranslationController::class, 'updateKey'])->name('translations.updateKey');

// // Route to add a new key to the translations (from the modal)
// Route::post('translations/add-key/{lang}', [TranslationController::class, 'addKey'])->name('translations.addKey');

// // Route to copy a language (add a new language)
// Route::post('translations/copy', [TranslationController::class, 'copy'])->name('translations.copy');
