<?php
Route::redirect('/', '/tracking');
// Route::redirect('/', '/login');
Route::get('/tracking', 'TrackingController@index')->name('tracking');
Route::get('/tracking/{order_id}', 'TrackingController@track')->name('track');

// Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

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

    // Product
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::resource('products', 'ProductController');

    // Location
    Route::get('locations/find-by-country/{country}', 'LocationController@findLocationByCountry')->name('locations.findLocationByCountry');
    Route::delete('locations/destroy', 'LocationController@massDestroy')->name('locations.massDestroy');
    Route::post('locations/media', 'LocationController@storeMedia')->name('locations.storeMedia');
    Route::post('locations/ckmedia', 'LocationController@storeCKEditorImages')->name('locations.storeCKEditorImages');
    Route::resource('locations', 'LocationController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Product Movement
    Route::delete('product-movements/destroy', 'ProductMovementController@massDestroy')->name('product-movements.massDestroy');
    Route::resource('product-movements', 'ProductMovementController');

    // Pending Stock In
    
    // Route::get('pending-stock-ins', 'PendingStockInController@index')->name('pending-stock-ins.index');
    // Route::resource('pending-stock-ins', 'PendingStockInController', ['only' => ['index', 'show']]);
    
    Route::post('pending-kh-stock-ins/stock-in', 'PendingKhStockInController@massStockIn')->name('pending-kh-stock-ins.massStockIn');
    Route::resource('pending-kh-stock-ins', 'PendingKhStockInController', ['only' => ['index', 'show']]);

    // Th Stock In
    Route::delete('th-stock-ins/destroy', 'ThStockInController@massDestroy')->name('th-stock-ins.massDestroy');
    Route::get('th-stock-ins/grouping', 'ThStockInController@grouping')->name('th-stock-ins.grouping');
    Route::post('th-stock-ins/grouping', 'ThStockInController@storeGrouping')->name('th-stock-ins.storeGrouping');
    Route::resource('th-stock-ins', 'ThStockInController');

    // Stock Out
    Route::delete('th-stock-outs/destroy', 'ThStockOutController@massDestroy')->name('th-stock-outs.massDestroy');
    Route::resource('th-stock-outs', 'ThStockOutController');

    // Kh Stock In
    Route::delete('kh-stock-ins/destroy', 'KhStockInController@massDestroy')->name('kh-stock-ins.massDestroy');
    Route::get('kh-stock-ins/grouping', 'KhStockInController@grouping')->name('kh-stock-ins.grouping');
    Route::post('kh-stock-ins/grouping', 'KhStockInController@storeGrouping')->name('kh-stock-ins.storeGrouping');
    Route::resource('kh-stock-ins', 'KhStockInController');

    // Stock Deliver
    Route::delete('stock-deliver/destroy', 'StockDeliverController@massDestroy')->name('stock-deliver.massDestroy');
    Route::resource('stock-deliver', 'StockDeliverController');

    // Stock Pickup
    Route::delete('stock-pickup/destroy', 'StockPickupController@massDestroy')->name('stock-pickup.massDestroy');
    Route::resource('stock-pickup', 'StockPickupController');

    // Stock In
    Route::delete('stock-ins/destroy', 'StockInController@massDestroy')->name('stock-ins.massDestroy');
    Route::get('stock-ins/grouping', 'StockInController@grouping')->name('stock-ins.grouping');
    Route::post('stock-ins/grouping', 'StockInController@storeGrouping')->name('stock-ins.storeGrouping');
    Route::resource('stock-ins', 'StockInController');

    // Stock Out
    Route::delete('stock-outs/destroy', 'StockOutController@massDestroy')->name('stock-outs.massDestroy');
    Route::resource('stock-outs', 'StockOutController');

    // Stock Complete
    Route::delete('stock-completes/destroy', 'StockCompleteController@massDestroy')->name('stock-completes.massDestroy');
    Route::resource('stock-completes', 'StockCompleteController');

    // Order Report
    // Route::delete('order-reports/destroy', 'OrderReportController@massDestroy')->name('order-reports.massDestroy');
    Route::get('order-reports', 'OrderReportController@index')->name('order-reports.index');
    // Route::resource('order-reports', 'OrderReportController');
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
