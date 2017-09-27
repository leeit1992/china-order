<?php
/*
|--------------------------------------------------------------------------
| Router for project
|--------------------------------------------------------------------------
*/

// Main index
$route->get('/', 'MainController@index');

// Check method Get
$route->get('/id/{id}', 'MainController@checkRouteGet');

$route->get('/page/{id}', 'MainController@index');

// Check method Post
$route->post('/validate', 'MainController@checkRoutePost');




/**
 * USER TOOOL
 */
$route->get('/user-tool', 'Frontend\MainController@main');
/*============================
=            Cart            =
============================*/

$route->post('/user-tool/addToCartHttp', 'Frontend\CartController@addToCartHttp');
$route->get('/user-tool/cart', 'Frontend\CartController@cartManage');
$route->post('/user-tool/updateCart', 'Frontend\CartController@updateCart');
$route->post('/user-tool/add-order', 'Frontend\CartController@addToOrder');


/*=====  End of Cart  ======*/


/*============================
=            User            =
============================*/

$route->get('/user-tool/login', 'Frontend\UserController@login');
$route->get('/user-tool/logout', 'Frontend\UserController@logout');
$route->get('/user-tool/register', 'Frontend\UserController@register');
$route->get('/user-tool/user-update-profile', 'Frontend\UserController@userUpdateProfile');
$route->get('/user-tool/user-info', 'Frontend\UserController@userInfo');

$route->post('/user-tool/validateLogin', 'Frontend\UserController@validateLogin');

/*=====  End of User  ======*/


/*=============================
=            Order            =
=============================*/

$route->get('/user-tool/order-success/{id}', 'Frontend\OrderController@orderSuccess');
$route->get('/user-tool/order-manage', 'Frontend\OrderController@orderManage');
$route->get('/user-tool/detail-order/{id}', 'Frontend\OrderController@orderDetail');
$route->post('/user-tool/update-order', 'Frontend\OrderController@updateOrder');

/*=====  End of Order  ======*/



/*=============================
=            Money            =
=============================*/

$route->get('/user-tool/recharge', 'Frontend\MoneyController@recharge');
$route->get('/user-tool/recharge-manage', 'Frontend\MoneyController@rechargeManage');
$route->get('/user-tool/revenue_expenditure', 'Frontend\MoneyController@revenueExpenditure');
$route->post('/user-tool/recharge-validate', 'Frontend\MoneyController@rechargeValidate');

/*=====  End of Money  ======*/




/**
 * Admin User Tool
 */
$route->get('/admcp', 'Backend\MainController@main');
/*===================================
=            Admin Login            =
===================================*/

$route->get('/admcp/login', 'Backend\UserController@login');
$route->get('/admcp/logout', 'Backend\UserController@logout');

$route->post('/admcp/validateLogin', 'Backend\UserController@validateLogin');

/*=====  End of Admin Login  ======*/

/*=============================
=            Order            =
=============================*/

$route->get('/admcp/order-manage', 'Backend\OrderController@orderManage');
$route->get('/admcp/detail-order/{id}', 'Backend\OrderController@orderDetail');
$route->post('/admcp/update-order', 'Backend\OrderController@updateOrder');

/*=====  End of Order  ======*/

/*=============================
=            Money            =
=============================*/

$route->get('/admcp/recharge', 'Backend\MoneyController@recharge');
$route->get('/admcp/recharge/{id}', 'Backend\MoneyController@recharge');
$route->get('/admcp/recharge-manage', 'Backend\MoneyController@rechargeManage');
$route->get('/admcp/info-pay', 'Backend\MoneyController@managePay');

$route->post('/admcp/recharge-validate', 'Backend\MoneyController@rechargeValidate');
$route->post('/admcp/add-pay-validate', 'Backend\MoneyController@addPayValidate');


/*=====  End of Money  ======*/

/*============================
=            User            =
============================*/

$route->get('/admcp/user-manage', 'Backend\UsersController@userManage');

/*=====  End of User  ======*/
