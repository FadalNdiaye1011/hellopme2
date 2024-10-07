<?php

use App\Http\Controllers\API\ActeurFinanceController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/home', [App\Http\Controllers\API\HomeAPIController::class, 'index'])->middleware('EnsureTokenIsValid')->name('api.home');
Route::get('/home-event', [App\Http\Controllers\API\HomeAPIController::class, 'index_event'])->middleware('EnsureTokenIsValid')->name('api.event');
Route::get('/home/{id}', [App\Http\Controllers\API\HomeAPIController::class, 'index_pays'])->middleware('EnsureTokenIsValid')->name('api.home.pays');
Route::get('/home-event/{id}', [App\Http\Controllers\API\HomeAPIController::class, 'index_event_pays'])->middleware('EnsureTokenIsValid')->name('api.event.pays');
Route::get('/home-by-type/{id}', [App\Http\Controllers\API\HomeAPIController::class, 'index_by_type'])->middleware('EnsureTokenIsValid')->name('api.opportunity.byType');
// Route::post('/register', [RegisterController::class, 'store'])->name('api.register');

Route::get('/logout', [App\Http\Controllers\API\LoginAPIController::class, 'logout'])->middleware('EnsureTokenIsValid')->name('api.logout');
Route::post('/signup/me', [App\Http\Controllers\API\LoginAPIController::class, 'register'])->name('api.signup');
Route::post('/signin/me', [App\Http\Controllers\API\LoginAPIController::class, 'login'])->name('api.signin');
Route::post('/oauth/token', [App\Http\Controllers\API\LoginAPIController::class, 'refresh_token'])->name('api.refresh');

// Route::post('social/login/{provider}', [App\Http\Controllers\API\LoginController::class, 'socialLogin']);
// Route::get('/login/{provider}', [App\Http\Controllers\API\LoginController::class,'redirectToProvider']);
// Route::get('/login/{provider}/callback', [App\Http\Controllers\API\LoginController::class,'handleProviderCallback']);
Route::post('/paydunya/response',[App\Http\Controllers\PaymentsController::class, 'callback_paydunya'])->name('callback_paydunya');

// Route::get('/user', [App\Http\Controllers\API\UserAPIController::class, 'show'])->middleware('EnsureTokenIsValid')->name('users.show');
Route::post('/user/forgot/password', [App\Http\Controllers\API\LoginAPIController::class, 'forgot_password'])->name('user.password.forgot');
Route::post('/user/code/password', [App\Http\Controllers\API\LoginAPIController::class, 'match_code'])->name('user.password.code');
Route::post('/user/reset/password', [App\Http\Controllers\API\LoginAPIController::class, 'reset_password'])->name('user.password.reset');
// Route::delete('/user/delete', [App\Http\Controllers\API\UserAPIController::class, 'destroy'])->middleware('EnsureTokenIsValid')->name('users.delete');

Route::resource('opportunities', App\Http\Controllers\API\OpportunityAPIController::class)
    ->middleware('EnsureTokenIsValid')
    ->except(['create', 'edit']);
Route::get('/opportunity/loadFormSearch', [App\Http\Controllers\API\OpportunityAPIController::class, 'load_search_form'])->middleware('EnsureTokenIsValid')->name('opportunity.load_search');
Route::post('/opportunity/research', [App\Http\Controllers\API\OpportunityAPIController::class, 'research'])->middleware('EnsureTokenIsValid')->name('opportunity.research');
Route::get('/opportunity/isfavored/{id}', [App\Http\Controllers\API\OpportunityAPIController::class, 'is_favored'])->middleware('EnsureTokenIsValid')->name('opportunity.isfavored');

Route::get('/secteur-activite/all', [App\Http\Controllers\API\SecteurActiviteAPIController::class, 'index_override'])->name('secteur-activites.display');
Route::get('/secteur-activite/choosen', [App\Http\Controllers\API\SecteurActiviteAPIController::class, 'choosen'])->middleware('EnsureTokenIsValid')->name('secteurs_activites.choosen');
Route::get('/secteur-activites/display/{topic}', [App\Http\Controllers\API\SecteurActiviteAPIController::class, 'displayed'])->middleware('EnsureTokenIsValid')->name('secteurs_activites.display');
Route::get('/secteur-activites/display/{topic}/{country}', [App\Http\Controllers\API\SecteurActiviteAPIController::class, 'displayed_pays'])->middleware('EnsureTokenIsValid')->name('secteurs_activites.display.pays');
Route::get('/secteur-activites/pays/{country}', [App\Http\Controllers\API\SecteurActiviteAPIController::class, 'index_pays'])->middleware('EnsureTokenIsValid')->name('secteurs_activites.pays');
Route::get('/secteur-activites/show/{topic}/{country}', [App\Http\Controllers\API\SecteurActiviteAPIController::class, 'show_pays'])->middleware('EnsureTokenIsValid')->name('secteurs_activites.show.pays');
Route::get('/pays-partner/choosen', [App\Http\Controllers\API\PaysPartnerAPIController::class, 'choosen'])->middleware('EnsureTokenIsValid')->name('pays-partners.choosen');
Route::get('/type-opportunity/choosen', [App\Http\Controllers\API\TypeOpportunityAPIController::class, 'choosen'])->middleware('EnsureTokenIsValid')->name('type_opportunities.choosen');
Route::resource('area-interests', App\Http\Controllers\API\AreaInterestAPIController::class)->middleware('EnsureTokenIsValid')
    ->except(['create', 'edit']);
Route::get('/finance/{type}', [App\Http\Controllers\API\FinanceAPIController::class, 'index_override'])
    ->middleware('EnsureTokenIsValid')
    ->name('api.finances.byType');
Route::get('/finance/{type}/{country}', [App\Http\Controllers\API\FinanceAPIController::class, 'index_override_pays'])
    ->middleware('EnsureTokenIsValid')
    ->name('api.finances.country');

Route::get('/watchlist/add/{opportunity}', [App\Http\Controllers\API\WatchlistAPIController::class, 'add'])->middleware('EnsureTokenIsValid')->name('watchlist.add');
Route::get('/watchlist/remove/{opportunity}', [App\Http\Controllers\API\WatchlistAPIController::class, 'remove'])->middleware('EnsureTokenIsValid')->name('watchlist.remove');
Route::get('/watchlists', [App\Http\Controllers\API\WatchlistAPIController::class, 'list'])->middleware('EnsureTokenIsValid')->name('watchlist.list');

//Protected resource routes
Route::resource('pays-partners', App\Http\Controllers\API\PaysPartnerAPIController::class)
    ->middleware('EnsureTokenIsValid')
    ->except(['create', 'edit']);
Route::resource('secteur-activites', App\Http\Controllers\API\SecteurActiviteAPIController::class)
    ->middleware('EnsureTokenIsValid')
    ->except(['create', 'edit']);
Route::resource('secteur_activite_children', App\Http\Controllers\API\Secteur_activite_childAPIController::class)
    ->middleware('EnsureTokenIsValid')
    ->except(['create', 'edit']);
Route::resource('prescripteurs', App\Http\Controllers\API\PrescripteurAPIController::class)
    ->middleware('EnsureTokenIsValid')
    ->except(['create', 'edit']);
Route::resource('attachments', App\Http\Controllers\API\AttachmentAPIController::class)
    ->middleware('EnsureTokenIsValid')
    ->except(['create', 'edit']);
Route::resource('finances', App\Http\Controllers\API\FinanceAPIController::class)
    ->middleware('EnsureTokenIsValid')
    ->except(['create', 'edit']);
Route::resource('services', App\Http\Controllers\API\ServiceAPIController::class)
    ->middleware('EnsureTokenIsValid')
    ->except(['create', 'edit']);
Route::resource('rate-tariffs', App\Http\Controllers\API\RateTariffAPIController::class)
    ->middleware('EnsureTokenIsValid')
    ->except(['create', 'edit']);

//No protected routes
Route::resource('addresses', App\Http\Controllers\API\AddressAPIController::class)
    ->except(['create', 'edit']);
Route::resource('expertise-domains', App\Http\Controllers\API\ExpertiseDomainAPIController::class)
    ->except(['create', 'edit']);
Route::resource('type-opportunities', App\Http\Controllers\API\TypeOpportunityAPIController::class)
    ->except(['create', 'edit']);
Route::resource('attachments', App\Http\Controllers\API\AttachmentsAPIController::class)
    ->except(['create', 'edit']);
Route::resource('files', App\Http\Controllers\API\FileAPIController::class)
    ->except(['create', 'edit']);
Route::resource('opportunity-secteur-children', App\Http\Controllers\API\OpportunitySecteurChildrenAPIController::class)
    ->except(['create', 'edit']);

Route::get('/acteur-finance', [ActeurFinanceController::class, 'index']);
Route::get('/acteur-finance/{id}', [ActeurFinanceController::class, 'show']);



