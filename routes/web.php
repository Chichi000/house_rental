<?php

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

// Home ====================================================================
Route::get('/', [
    'uses' => 'PropertyController@getHome',
    'as' => 'getHome',
]);

Route::get('/property/{id}', [
    'uses' => 'PropertyController@show',
    'as' => 'showProperty',
]);

// serach for properties
Route::get('/search', 'PropertyController@search_property')->name('search_property');

// Route::group(['prefix' => 'user'], function(){
Route::group(['middleware' => 'guest'], function () {
    Route::post('/register-tenant', [
        'uses' => 'TenantController@register',
        'as' => 'regtenant',
    ]);

    Route::post('/register-landlord', [
        'uses' => 'LandlordController@register',
        'as' => 'reglandlord',
    ]);

    Route::get('signin', [
        'uses' => 'LoginController@getSignin',
        'as' => 'user.signins',
    ]);

    Route::post('signin', [
        'uses' => 'LoginController@postSignin',
        'as' => 'user.signin',
    ]);

    Route::get('signup-tenant', [
        'uses' => 'LoginController@getTsignup',
        'as' => 'user.Tsignup',
    ]);

    Route::get('signup-landlord', [
        'uses' => 'LoginController@getLsignup',
        'as' => 'user.Lsignup',
    ]);

}); // end of middleware guest

Route::group(['middleware' => 'role:tenant,landlord'], function () {
    Route::get('/tenant-profile', [
        'uses' => 'TenantController@profile',
        'as' => 'tenant.profile',
    ]);

    Route::get('/landlord-profile', [
        'uses' => 'LandlordController@profile',
        'as' => 'landlord.profile',
    ]);
}); // end of middleware tenant and landlord

//Route group for landlord and admin
Route::group(['middleware' => 'role:admin'], function () {

    // Dashboard (charts)====================================================================
    Route::get('/dashboard', [
        'uses' => 'DashboardController@demographicChart',
        'as' => 'dashboard.index',
    ]);
    //Route auth for landlord datatable
    Route::resource('landlord', 'LandlordController');

    Route::get('/landlord', [
        'uses' => 'LandlordController@getLandlords',
        'as' => 'getLandlords',
    ]);

    Route::delete('/landlord/deactivate/{id}', [
        'uses' => 'LandlordController@deactivate',
        'as' => 'landlord.deactivate',
    ]);

    Route::get('/landlord/restore/{id}', [
        'uses' => 'LandlordController@restore',
        'as' => 'landlord.restore',
    ]);

    Route::post('/landlord/verified/{id}', [
        'uses' => 'LandlordController@upgraded',
        'as' => 'landlord.verified',
    ]);

    Route::get('/admin/index-verification', [
        'uses' => 'AdminController@indexVerification',
        'as' => 'admin.indexVerification',
    ]);

    Route::post('/admin/landlord-status/{id}', [
        'uses' => 'AdminController@editStatus',
        'as' => 'admin.editStatus',
    ]);

//===============================================================================
    //Route auth for property datatable
    Route::resource('property', 'PropertyController');

    Route::post('/property/approved/{id}', [
        'uses' => 'PropertyController@approval',
        'as' => 'property.approved',
    ]);
//===============================================================================
    //Route auth for tenant datatable
    Route::resource('tenant', 'TenantController');

    Route::get('/tenant', [
        'uses' => 'TenantController@getTenants',
        'as' => 'getTenants',
    ]);

    Route::delete('/tenant/deactivate/{id}', [
        'uses' => 'TenantController@deactivate',
        'as' => 'tenant.deactivate',
    ]);

    Route::get('/tenant/restore/{id}', [
        'uses' => 'TenantController@restore',
        'as' => 'tenant.restore',
    ]);

}); // end of middleware admin

//Route group for landlord POV
Route::group(['middleware' => 'role:landlord'], function () {

    //Only landlord can access this route lists below:
    Route::resource('property', 'PropertyController')->only(['update']);
    Route::resource('landlord', 'LandlordController')->only(['update']);

    Route::get('/my-properties', [
        'uses' => 'LandlordController@myProperties',
        'as' => 'landlord.properties',
    ]);

    Route::post('/create-property', [
        'uses' => 'PropertyController@store',
        'as' => 'getProps',
    ]);

    Route::get('/property/edit/{id}', [
        'uses' => 'PropertyController@edit',
        'as' => 'editProperty',
    ]);

    Route::post('/property/available/{id}', [
        'uses' => 'PropertyController@available',
        'as' => 'property.available',
    ]);

    Route::post('/property/taken/{id}', [
        'uses' => 'PropertyController@taken',
        'as' => 'property.taken',
    ]);

    Route::post('/landlord/verification', [
        'uses' => 'LandlordController@verification',
        'as' => 'landlord.verification',
    ]);

    Route::get('/transaction', [
        'uses' => 'TransactionController@getTransaction',
        'as' => 'getTransaction',
    ]);

    Route::post('/transaction/edit-status/{id}', [
        'uses' => 'TransactionController@editStatus',
        'as' => 'transaction.editStatus',
    ]);

}); // end of middleware landlord

// Route group for tenant POV
Route::group(['middleware' => 'role:tenant'], function () {

    //Only tenant can access this route lists below:
    Route::resource('tenant', 'TenantController')->only(['update']);

    Route::post('/review', [
        'uses' => 'ReviewController@store',
        'as' => 'review.store',
    ]);

    Route::get('/transaction/property-{id}', [
        'uses' => 'TransactionController@show',
        'as' => 'showTransaction',
    ]);

    Route::get('/tenant/edit/{id}', [
        'uses' => 'TenantController@edit',
        'as' => 'editTenant',
    ]);

    Route::post('/transaction/check-out', [
        'uses' => 'TransactionController@requestProperty',
        'as' => 'transaction.requestProperty',
    ]);
}); // end of middleware tenant

// Route group for admin and landlord POV
Route::group(['middleware' => 'role:admin,landlord'], function () {

    //Only landlord and admin can access this route lists below:
    
    Route::get('/property', [
        'uses' => 'PropertyController@getProperties',
        'as' => 'getProperties',
    ]);

    Route::delete('/property/deactivate/{id}', [
        'uses' => 'PropertyController@deactivate',
        'as' => 'property.deactivate',
    ]);

    Route::get('/property/restore/{id}', [
        'uses' => 'PropertyController@restore',
        'as' => 'property.restore',
    ]);

}); // end of middleware tenant

// }); // end of Route Group Prefix

// All users can access this route lists below:

//Conversation
Route::get('conversation', 'MessageController@tenet_conversation')->name('tenet_conversation');
Route::get('inbox/{id}', 'MessageController@inbox')->name('con');
Route::get('message/{id}', 'MessageController@messagebox')->name('inbox');
Route::post('messageinsert', 'MessageController@insert')->name('sendmessage');
Route::get('applicant/message/{id}', 'MessageController@messagebox')->name('showmessagebox'); // Change route for adivsor conversation to this.
Route::post('usertyping', 'MessageController@typing')->name('usertyping');
Route::post('usernottyping', 'MessageController@nottyping')->name('usernottyping');
Route::post('readuserstatus', 'MessageController@readuserstatus')->name('readuserstauts');
Route::post('readusermessage', 'MessageController@readusermessage')->name('readusermessage');
Route::post('readunseenmessage', 'MessageController@readunseenmessage')->name('readunseenmessage');

Route::get('/transaction/property-{id}', [
    'uses' => 'TransactionController@show',
    'as' => 'showTransaction',
]);

Route::get('logout', [
    'uses' => 'LoginController@logout',
    'as' => 'user.logout',
    'middleware' => 'auth',
]);

Route::fallback(function () {
    return redirect()->back();
});

Route::get('generate-pdf/{id}', [
    'uses' => 'PDFController@generatePDF',
    'as' => 'receipt',
]);
