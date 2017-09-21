<?php
/*
|--------------------------------------------------------------------------
| Router for project
|--------------------------------------------------------------------------
*/

// Main index
$route->get('/','MainController@index');

// Check method Get
$route->get('/id/{id}','MainController@checkRouteGet');

$route->get('/page/{id}','MainController@index');

// Check method Post
$route->post('/validate','MainController@checkRoutePost');


/**
 * Admin User Tool
 */


/*===================================
=            Admin Login            =
===================================*/

$route->get('/admcp/login','Backend\UserController@login');
$route->get('/admcp/logout','Backend\UserController@logout');

/*=====  End of Admin Login  ======*/





/**
 * USER TOOOL
 */
$route->get('/user-tool','Frontend\MainController@main');
/*============================
=            Cart            =
============================*/

$route->post('/user-tool/addToCartHttp','Frontend\CartController@addToCartHttp');
$route->get('/user-tool/cart','Frontend\CartController@cartManage');
$route->post('/user-tool/updateCart','Frontend\CartController@updateCart');
$route->post('/user-tool/add-order','Frontend\CartController@addToOrder');


/*=====  End of Cart  ======*/


/*============================
=            User            =
============================*/

$route->get('/user-tool/login','Frontend\UserController@login');
$route->get('/user-tool/logout','Frontend\UserController@logout');
$route->get('/user-tool/register','Frontend\UserController@register');
$route->get('/user-tool/user-update-profile','Frontend\UserController@userUpdateProfile');
$route->get('/user-tool/user-info','Frontend\UserController@userInfo');

$route->post('/user-tool/validateLogin','Frontend\UserController@validateLogin');

/*=====  End of User  ======*/


/*=============================================
=            Section comment block            =
=============================================*/

$route->get('/user-tool/order-success','Frontend\OrderController@orderSuccess');
$route->get('/user-tool/order-manage','Frontend\OrderController@orderManage');


/*=====  End of Section comment block  ======*/


/*=============================
=            Money            =
=============================*/

$route->get('/user-tool/recharge','Frontend\MoneyController@recharge');
$route->get('/user-tool/recharge-manage','Frontend\MoneyController@rechargeManage');
$route->post('/user-tool/recharge-validate','Frontend\MoneyController@rechargeValidate');

/*=====  End of Money  ======*/




