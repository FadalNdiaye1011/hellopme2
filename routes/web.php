<?php

use App\Http\Controllers\ActeurFinanceController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Secteur_activite_childController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TypeFinanceController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/get-sous-secteurs/{secteurId}', [App\Http\Controllers\DatabanksController::class, 'getSousSecteurs']);
// routes/web.php
Route::post('/databanks/reset-status', 'DatabanksController@resetStatus');


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profil', [App\Http\Controllers\HomeController::class, 'profile'])->name('users.profil');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
// Route::get('/register', function () { return view('auth.register'); })->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register');
Route::get('/plan', function () {
    return view('pricing_plan');
})->name('plan');



Route::post('/purchase', [App\Http\Controllers\PaymentsController::class, 'purchase'])->name('purchase');
// Callback must be on the api.php scope
// Route::post('/success-payment',[App\Http\Controllers\PaymentsController::class, 'successPayment'])->name('success_payment');
Route::get('/cancel-payment', [App\Http\Controllers\PaymentsController::class, 'cancelPayment'])->name('cancel_payment');

Route::get('/financements', [App\Http\Controllers\HomeController::class, 'financements'])->name('home.financements');
Route::get('/evenements', [App\Http\Controllers\HomeController::class, 'evenements'])->name('home.evenements');
// Route::get('/accueil', function () { return view('accueil'); })->name('accueil');
Route::get('/accueil', [App\Http\Controllers\PageAccueil::class, 'index'])->name('accueil');
// web.php
Route::get('/get-sous-secteurs', [App\Http\Controllers\Auth\RegisterController::class, 'getSousSecteurs']);

Route::get('/detail-appel-offre/{opportunity}', [App\Http\Controllers\HomeController::class, 'detail_appel_offre'])->name('home.detail_appel_offre');
Route::get('/opportunities/search', [App\Http\Controllers\HomeController::class, 'search'])->name('opportunities.search');
Route::post('/watchlist/add/{opportunity}', [App\Http\Controllers\WatchlistController::class, 'add'])->name('watchlist.add');
Route::delete('/watchlist/remove/{opportunity}', [App\Http\Controllers\WatchlistController::class, 'remove'])->name('watchlist.remove');

Route::post('/save-abonnement', [App\Http\Controllers\HomeController::class, 'storeAbonnement'])->name('home.storeAbonnement');

Auth::routes();

// Route::get('/save-register', [App\Http\Controllers\HomeController::class, 'index'])->name('register');
Route::group([
    'prefix' => 'dashboard'
], function () {
    Route::group(['middleware' => ['role:admin']], function () {
        Route::resource('addresses', App\Http\Controllers\AddressController::class);
        Route::resource('pays-partners', App\Http\Controllers\PaysPartnerController::class);
        Route::resource('expertise-domains', App\Http\Controllers\ExpertiseDomainController::class);
        Route::resource('secteur-activites', App\Http\Controllers\SecteurActiviteController::class);
        Route::resource('website-links', App\Http\Controllers\WebsiteLinkController::class);
        Route::resource('roles', App\Http\Controllers\RoleController::class);
        Route::resource('permissions', App\Http\Controllers\PermissionController::class);
        Route::resource('users', App\Http\Controllers\UserController::class);
        Route::post('/assign-user-role', [App\Http\Controllers\UserController::class, 'assignUserRole'])->name('assignRoleToUser');
        Route::get('/parameters', [App\Http\Controllers\UserController::class, 'parameter_page'])->name('parameters');
        Route::resource('type-opportunities', App\Http\Controllers\TypeOpportunityController::class);
        Route::resource('area-interests', App\Http\Controllers\AreaInterestController::class);
        Route::resource('prescripteurs', App\Http\Controllers\PrescripteurController::class);
        Route::resource('secteur-activite-children', App\Http\Controllers\Secteur_activite_childController::class);
        Route::resource('opportunity-secteur-children', App\Http\Controllers\OpportunitySecteurChildrenController::class);
        // Route for AJAX search
        Route::get('/secteur-activite-children/search', [Secteur_activite_childController::class, 'search'])->name('secteur-activite-children.search');
        Route::resource('attachments', App\Http\Controllers\AttachmentsController::class);
        Route::resource('files', App\Http\Controllers\FileController::class);
    });

    Route::group(['middleware' => ['role:editor|admin']], function () {
        Route::resource('opportunities', App\Http\Controllers\OpportunityController::class);
    });

    Route::group(['middleware' => ['role:validator|editor|admin']], function () {
        Route::get('databanks/validate/{id}', [App\Http\Controllers\DatabanksController::class, 'validateData'])->name('databanks.validate');
        Route::resource('databanks', App\Http\Controllers\DatabanksController::class);
        Route::get('databanks/{id}/cancel', [App\Http\Controllers\DatabanksController::class, 'cancelLock'])->name('databanks.cancel');
        Route::get('', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    });

    // Route::resource('finances', App\Http\Controllers\FinanceController::class);


    // Route::resource('services', App\Http\Controllers\ServiceController::class);
    // Route::get('/service/{id}', [App\Http\Controllers\ServiceController::class, 'create_override'])->name('service.create');
    Route::resource('rate-tariffs', App\Http\Controllers\RateTariffController::class);
    Route::get('/rate-tariff/{id}', [App\Http\Controllers\RateTariffController::class, 'create_override'])->name('rate-tariff.create');
    Route::resource('abonnements', App\Http\Controllers\AbonnementController::class);
    Route::resource('user-abonnements', App\Http\Controllers\UserAbonnementController::class);


    // Type_finances
    Route::get('/type-finances', [TypeFinanceController::class, 'index'])->name('type-finances.index');
    Route::get('/type-finances/{id}', [TypeFinanceController::class, 'show'])->name('type-finances.show');
    Route::get('/type-finances/create', [TypeFinanceController::class, 'create'])->name('type-finances.create');
    Route::post('/type-finances', [TypeFinanceController::class, 'store'])->name('type-finances.store');
    Route::get('/type-finances/{id}/edit', [TypeFinanceController::class, 'edit'])->name('type-finances.edit');
    Route::post('/type-finances/{id}', [TypeFinanceController::class, 'update'])->name('type-finances.update');
    Route::delete('/type-finances/{id}', [TypeFinanceController::class, 'destroy'])->name('type-finances.destroy');

    // ACTEUR FINANCES

    Route::resource('acteur-finances', ActeurFinanceController::class);


    Route::get('/typeFinance/list/{id}', [HomeController::class, 'showListeBanque'])->name('typeFinance.list');


    // service
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/{id}', [ServiceController::class, 'show'])->name('services.show');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::post('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');

    Route::get('acteur-finances/{id}/select-services', [ActeurFinanceController::class, 'selectServices'])->name('acteur-services.select');
    Route::post('acteur-finances/{id}/services', [ActeurFinanceController::class, 'storeServices'])->name('acteur-services.store');
});


// Route::get('lang/{locale}', [App\Http\Controllers\LanguageController::class, 'switch'])->name('lang.switch');

Route::resource('attachments', App\Http\Controllers\AttachmentController::class);

// Route::get('/test', function () {
//     return view('home');
// });
