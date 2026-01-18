<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\InfoligneController;
use App\Http\Controllers\PermissionController;


Route::middleware(SetLocale::class)->group(function(){
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('lespages/accueil');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Auth::routes();
//les routes de suppressions
Route::group(['middleware' => ['auth','role:Super-Administrateur']], function() {
        Route::resource('permissions', PermissionController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);

        Route::get('permissions/{roleId}/destroy', action: [App\Http\Controllers\PermissionController::class, 'destroy']);
        Route::get('roles/{roleId}/destroy', [App\Http\Controllers\RoleController::class, 'destroy']);
        Route::get('users/{roleId}/destroy', [App\Http\Controllers\UserController::class, 'destroy']);

        Route::get('roles/{roleId}/permisroles', [App\Http\Controllers\RoleController::class, 'permisroles']);
        Route::put('roles/{roleId}/dontpermirole', [App\Http\Controllers\RoleController::class, 'dontpermirole']);
});

Route::group(['middleware' => ['auth','role:Super-Administrateur|Administrateur']], function() {
    Route::resource('carousels', CarouselController::class);
    Route::resource('profils', ProfilController::class);
    Route::resource('infolignes', InfoligneController::class);
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
