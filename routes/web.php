<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

// Custom redirect rules (from old site)
Route::get('tentang-perusahaan', function () {
    $defaultLang = Config::get('cms.default_language', 'en');
    return redirect()->route('cms.page', ['lang' => $defaultLang, 'slug' => 'profil-perusahaan']);
});

Route::get('whistle-blowing-system-wbs-pengendalian-gratifikasi', function () {
    $defaultLang = Config::get('cms.default_language', 'en');
    return redirect()->route('cms.page', ['lang' => $defaultLang, 'slug' => 'whistleblowing']);
});

Route::get('tag/direksi-pt-kiw-persero/{any?}', function ($any = null) {
    $defaultLang = Config::get('cms.default_language', 'en');
    return redirect()->route('cms.page', ['lang' => $defaultLang, 'slug' => 'manajemen-perusahaan']);
})->where('any', '.*');

Route::get('category/{any}', function ($any) {
    $defaultLang = Config::get('cms.default_language', 'en');
    return redirect()->to('/' . $defaultLang . '/categories/' . $any);
});
