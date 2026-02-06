<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ApropoController;
use App\Http\Controllers\CentreController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\TemoinController;
use App\Http\Controllers\CandidatController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\DirigentController;
use App\Http\Controllers\ResultatController;
use App\Http\Controllers\UseretabController;
use App\Http\Controllers\InfoligneController;
use App\Http\Controllers\EvennementController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\AnneescolaireController;
use App\Http\Controllers\EtablissementController;
use App\Http\Controllers\CategoriesExamenController;
use App\Http\Controllers\UserEtablissementController;
use App\Http\Controllers\CentreEtablissementExamenController;


Route::middleware(SetLocale::class)->group(function(){
// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', function () {
//     return view('lespages/accueil');
// });


Route::get('/', [App\Http\Controllers\PageController::class, 'acceuil']);
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

Route::post('/confirmation', [ConfirmationController::class, 'confirmerCompte'])->name('confirmerCompte');

Route::group(['middleware' => ['auth','role:Super-Administrateur|Administrateur']], function() {
    Route::resource('carousels', CarouselController::class);
    Route::resource('profils', ProfilController::class);
    Route::resource('infolignes', InfoligneController::class);
    Route::resource('etabusers', UseretabController::class);
    Route::resource('centres', CentreController::class);
    Route::resource('etablissements', EtablissementController::class);
    Route::resource('user-etablissements', UserEtablissementController::class);
    Route::resource('organisations', OrganisationController::class);
    Route::resource('evennements', EvennementController::class);
    Route::resource('anneescolaires', AnneescolaireController::class);
    Route::resource('apropos', ApropoController::class);
    Route::resource('information', InformationController::class);
    Route::resource('dirigents', DirigentController::class);
    Route::resource('inscriptions', InscriptionController::class);
    Route::put('lire/{id}/messages_etabli', [App\Http\Controllers\InfoligneController::class,'liremessage'])->name('lire.messages_etabli');
    Route::post('/etablissements/association', [App\Http\Controllers\UserEtablissementController::class, 'etablissementAssociation'])->name('etablissements.association');
});

Route::group(['middleware' => ['auth','role:Super-Administrateur|Secondaire']], function() {
    Route::resource('centres', CentreController::class);
    Route::resource('etablissements', EtablissementController::class);
    Route::resource('inscriptions', InscriptionController::class);

    Route::resource('categories-examens', CategoriesExamenController::class);
    Route::resource('centre-etablissement-examens', CentreEtablissementExamenController::class);
    Route::resource('candidats', CandidatController::class);

    Route::get('/import', [ResultatController::class, 'charger'])->name('charger');
    Route::get('/resultats', [ResultatController::class, 'index'])->name('resultats.index');
    Route::post('/resultats/import', [ResultatController::class, 'import'])->name('resultats.import');
});
// routes ar
Route::get('contact', [App\Http\Controllers\PageController::class, 'contact'])->name('contacts');
Route::get('a_propos', [App\Http\Controllers\PageController::class, 'apropos'])->name('a_propos');
Route::get('galleries', [App\Http\Controllers\PageController::class, 'galleries'])->name('galleries');
Route::get('acceuil', [App\Http\Controllers\PageController::class, 'acceuil'])->name('acceuils');
Route::get('detail/{id}/domaine', [App\Http\Controllers\PageController::class, 'detaildomaine'])->name('detail.domaine');

Route::resource('temoins', TemoinController::class);
Route::patch('/temoins/{id}/toggle', [TemoinController::class, 'temoinsStatus'])->name('temoins.status');
Route::resource('infolignes', InfoligneController::class);


Route::get('/events', [EventController::class, 'index']);

Route::get('/consultation-resultats', [ResultatController::class, 'consultation'])->name('consultation.resultats');
// recherche_resultat_sanawi
Route::get('/resultats-2025-2026_sanawi', [ResultatController::class, 'consultation_sanawi'])->name('resultats.sanawi');
Route::post('/resultats-2025-2026_sanawi', [ResultatController::class, 'recherche_sanawi'])->name('recherche.sanawi');
// recherche_resultat_moutawasith
Route::get('/resultats-2025-2026_moutawasith', [ResultatController::class, 'consultation_moutawasith'])->name('resultats.moutawasith');
Route::post('/resultats-2025-2026_moutawasith', [ResultatController::class, 'recherche_moutawasith'])->name('recherche.moutawasith');

Route::get('/lang/{locale}', function ($locale) {
    $locales = ['fr', 'ar', 'en'];

    if (in_array($locale, $locales)) {
        session(['locale' => $locale]);
    }

    return redirect()->back();
})->name('langue.choisir');

});
