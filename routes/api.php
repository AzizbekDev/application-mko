<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');
});

// Application Services
Route::group([
    'namespace'  => 'Api\V1\Application',
    'middleware' => ['auth.partner']], function () {
    Route::post('rest', 'RestController@index');
    Route::post('condition', 'ConditionInfoController@index');
});
// Application Conditions For Mobile Server
Route::group(['namespace'  => 'Api\V1\Application'], function () {
    Route::get('condition', 'ConditionInfoController@index');
});

// Tax Services
Route::group([
    'namespace'  => 'Api\V1\Unired',
    'middleware' => ['auth.partner']], function () {
    Route::post('tax', 'TaxController@index');
});

// Katm Services
Route::group([
    'namespace'  => 'Api\V1\Unired',
    'middleware' => ['auth.partner']], function () {
    Route::post('credit', 'KatmController@index');
});
