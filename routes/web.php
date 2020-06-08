<?php

//use Illuminate\Routing\Route;

Route::get('/', [
    'uses' => 'HomeController@home',
    'as' => 'home'
]);

Route::get('/about', function () {
    return view('user.about');
});


Route::get('/contact', function () {
    return view('user.contact');
});

Route::get('/login', function () {
    return view('user.login');
})->name('getLogin')->middleware('guest');

Route::get('/register', function () {
    return view('user.register');
})->middleware('guest');

Route::post('/register', [
    'uses' => 'UserController@postRegister',
    'as' => 'postRegister',
    'middleware' =>'guest'
]);

Route::post('/login', [
    'uses' => 'UserController@postLogin',
    'as' => 'postLogin',
    'middleware' =>'guest'
]);

Route::get('/profile', [
    'uses' => 'UserController@getProfile',
    'as' => 'getProfile',
    'middleware' =>'auth'
]);

Route::get('/logout', [
    'uses' => 'UserController@getLogout',
    'as' => 'getLogout',
    'middleware' =>'auth'
]);

// home controller route
Route::get('/service/{id}', [
    'uses' => 'HomeController@getService',
    'as' => 'getService'
]);

Route::get('/supplement/{id}', [
    'uses' => 'HomeController@getSupplement',
    'as' => 'getSupplement'
]);

Route::get('/supplements', [
    'uses' => 'HomeController@getAllSupplements',
    'as' => 'getAllSupplements'
]);

Route::get('/booking', [
    'uses' => 'HomeController@getBooking',
    'as' => 'getBooking'
]);

Route::post('/booking', [
    'uses' => 'HomeController@postBooking',
    'as' => 'postBooking'
]);

Route::get('/delete', [
    'uses' => 'HomeController@deleteBooking',
    'as' => 'deleteBooking'
]);

Route::get('/confirm', [
    'uses' => 'HomeController@confirmBooking',
    'as' => 'confirmBooking'
]);

Route::get('/appointment', [
    'uses' => 'HomeController@getAppointment',
    'as' => 'getAppointment'
]);

Route::post('/search', [
    'uses' => 'HomeController@getSearchSupplements',
    'as' => 'getSearchSupplements'
]);

Route::get('/cart', [
    'uses' => 'HomeController@getCart',
    'as' => 'getCart'
]);

Route::get('/remove/{id}', [
    'uses' => 'HomeController@getRemoveItem',
    'as' => 'getRemoveItem'
]);

Route::get('/checkout', [
    'uses' => 'HomeController@getCheckout',
    'as' => 'getCheckout',
    'middleware' => 'auth'
]);

Route::post('/checkout', [
    'uses' => 'HomeController@postCheckout',
    'as' => 'postCheckout',
    'middleware' => 'auth'
]);

Route::post('/post/{id}', [
    'uses' => 'HomeController@postReview',
    'as' => 'postReview'
]);

Route::get('/category/{id}', [
    'uses' => 'HomeController@getSupplementCategory',
    'as' => 'getSupplementCategory'
]);

Route::get('/add/{id}', [
    'uses' => 'HomeController@getAddToCart',
    'as' => 'getAddToCart'
]);


// admin routes
Route::get('/admin-login', [
    'uses' => 'HcpLoginController@getAdminLogin',
    'as' => 'getAdminLogin'
]);

Route::post('/admin-login', [
    'uses' => 'HcpLoginController@postAdminLogin',
    'as' => 'postAdminLogin'
]);

Route::get('/dashboard', [
    'uses' => 'HcpController@getAdminDashboard',
    'as' => 'getAdminDashboard'
]);

Route::get('/add-product', [
    'uses' => 'HcpController@getAddProduct',
    'as' => 'getAddProduct'
]);

Route::post('/add-product', [
    'uses' => 'HcpController@postAddProduct',
    'as' => 'postAddProduct'
]);

Route::post('/add-discount', [
    'uses' => 'HcpController@addSupplementDiscount',
    'as' => 'addSupplementDiscount'
]);

Route::post('/product-update/{id}', [
    'uses' => 'HcpController@updateQuantity',
    'as' => 'updateQuantity'
]);

Route::get('/get-booking', [
    'uses' => 'HcpController@getAllBooking',
    'as' => 'getAllBooking'
]);

Route::get('/get-chart', [
    'uses' => 'HcpController@getChart',
    'as' => 'getChart'
]);

Route::get('/get-charts', [
    'uses' => 'ChartsDataController@getMonthlyPostData',
    'as' => 'getCharts'
]);

Route::get('/get-order', [
    'uses' => 'HcpController@getOrder',
    'as' => 'getOrder'
]);

Route::get('/get-order-completed/{id}', [
    'uses' => 'HcpController@getCompletedOrder',
    'as' => 'getCompletedOrder'
]);

Route::get('/get-user', [
    'uses' => 'HcpController@getUser',
    'as' => 'getUser'
]);

Route::get('/get-admin', [
    'uses' => 'HcpController@getAdmin',
    'as' => 'getAdmin'
]);

Route::get('/get-completed/{id}', [
    'uses' => 'HcpController@getCompleted',
    'as' => 'getCompleted'
]);

Route::post('/add-service', [
    'uses' => 'HcpController@postAddService',
    'as' => 'postAddService'
]);


Route::get('/get-delete/{id}', [
    'uses' => 'HcpController@getDelete',
    'as' => 'getDelete'
]);

Route::get('/out', [
    'uses' => 'HcpController@getHcpLogout',
    'as' => 'getHcpLogout'
]);
