<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }
    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

// Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Pages
    Route::get('search', 'SearchController@index');
    Route::post('search', 'SearchController@search')->name('application.search');
    Route::get('reports', 'ReportsController@index')->name('application.reports');

    // Brands
    Route::resource('brands', 'BrandsController')->only(['index', 'show']);

    // Merchants
    Route::resource('merchants', 'MerchantsController')->only(['index', 'show']);

    // Merchant Periods
    Route::resource('merchant-periods', 'MerchantPeriodsController')->only(['index', 'show']);

    //Settings
    Route::resource('settings', 'SettingsController');

    // Applications
    Route::get('applications', 'ApplicationsController@index')->name('applications.index');
    Route::get('applications/new', 'ApplicationsController@new')->name('applications.new');
    Route::get('applications/viewed', 'ApplicationsController@viewed')->name('applications.viewed');
    Route::get('applications/approved', 'ApplicationsController@approved')->name('applications.approved');
    Route::get('applications/rejected', 'ApplicationsController@rejected')->name('applications.rejected');
    Route::get('applications/blocked', 'ApplicationsController@blocked')->name('applications.blocked');

    // Clients
    Route::get('clients', 'ClientsController@index')->name('clients.index');
    Route::get('client/info/{client}', 'ClientsController@show')->name('clients.show');
    Route::post('client/wallet-create', 'ClientsController@createWallet')->name('clients.wallet.create');
    Route::post('client/reject', 'ClientsController@reject')->name('clients.reject');
    Route::post('client/status-change', 'ClientsController@statusChange')->name('clients.status.change');
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
