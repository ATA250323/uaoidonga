<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CarouselController;


Route::middleware(SetLocale::class)->group(function(){
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('lespages/accueil');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Auth::routes();
Route::group(['middleware' => ['auth','role:Super-Administrateur|Administrateur']], function() {
    Route::resource('carousels', CarouselController::class);
});
// routes ar
Route::get('contact', [App\Http\Controllers\PageController::class, 'contact'])->name('contacts');
Route::get('apropos', [App\Http\Controllers\PageController::class, 'apropos'])->name('apropos');
Route::get('galleries', [App\Http\Controllers\PageController::class, 'galleries'])->name('galleries');
Route::get('acceuil', [App\Http\Controllers\PageController::class, 'acceuil'])->name('acceuils');



Route::get('/events', [EventController::class, 'index']);


Route::get('/lang/{locale}', function ($locale) {
    $locales = ['fr', 'ar', 'en'];

    if (in_array($locale, $locales)) {
        session(['locale' => $locale]);
    }

    return redirect()->back();
})->name('langue.choisir');

});
