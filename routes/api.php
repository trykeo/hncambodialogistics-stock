<?php

// PUBLIC API
Route::group(['prefix' => 'v1/public', 'as' => 'api.', 'namespace' => 'Api\V1\Admin\Public'], function () {
    // Product
    // group
    Route::get('product-groups', 'ProductApiController@group');
    Route::apiResource('products', 'ProductApiController', ['only' => ['index', 'show']]);

    // Location
    Route::apiResource('locations', 'LocationApiController', ['only' => ['index', 'show']]);

    // Product Movement
    Route::apiResource('product-movements', 'ProductMovementApiController', ['only' => ['index', 'show']]);
});


Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Users
    Route::apiResource('users', 'UsersApiController');

    // Product
    Route::apiResource('products', 'ProductApiController');

    // Location
    Route::post('locations/media', 'LocationApiController@storeMedia')->name('locations.storeMedia');
    // Route::get('locations/find-by-country/{country}', 'LocationApiController@findLocationByCountry')->name('locations.findLocationByCountry');
    Route::apiResource('locations', 'LocationApiController');

    // User Alerts
    Route::apiResource('user-alerts', 'UserAlertsApiController', ['except' => ['update']]);

    // Product Movement
    Route::apiResource('product-movements', 'ProductMovementApiController');
});
