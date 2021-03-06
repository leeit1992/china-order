<?php
/*
|--------------------------------------------------------------------------
| Router for project
|--------------------------------------------------------------------------
*/

// Main index
$route->get('/', 'MainController@index');
$route->get('/page/{slug}/{id}', 'MainController@singlePage');

// Check method Post
$route->post('/validate', 'MainController@checkRoutePost');
$route->post('/status-notice','MainController@handleNoticeStatus');

/**
 * USER TOOOL
 */
$route->get('/user-tool', 'Frontend\MainController@main');
/*============================
=            Cart            =
============================*/

$route->post('/user-tool/addToCartHttp', 'Frontend\CartController@addToCartHttp');
$route->post('/user-tool/addToCartHttp2', 'Frontend\CartController@addToCart2');
$route->post('/user-tool/exchange', 'Frontend\CartController@exchange');
$route->get('/user-tool/cart', 'Frontend\CartController@cartManage');
$route->post('/user-tool/updateCart', 'Frontend\CartController@updateCart');
$route->post('/user-tool/add-order', 'Frontend\CartController@addToOrder');
$route->get('/user-tool/delete-cart/{id}', 'Frontend\CartController@deleteCart');
$route->get('/user-tool/delete-carts/{id}', 'Frontend\CartController@deleteCarts');
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
$route->post('/user-tool/changePass', 'Frontend\UserController@changePass');
$route->post('/user-tool/validateUser','Frontend\UserController@validateUser' );

$route->get('/user-tool/notice-manage', 'Frontend\UserController@noticeManage');
$route->get('/user-tool/notice-delete/{id}','Frontend\UserController@deleteNotice' );

/*=====  End of User  ======*/


/*=============================
=            Order            =
=============================*/

$route->get('/user-tool/order-success/{id}', 'Frontend\OrderController@orderSuccess');
$route->get('/user-tool/order-manage', 'Frontend\OrderController@orderManage');
$route->get('/user-tool/detail-order/{id}', 'Frontend\OrderController@orderDetail');
$route->post('/user-tool/update-order', 'Frontend\OrderController@updateOrder');

$route->get('/user-tool/ajax-userT-order-manage','Frontend\OrderController@ajaxOrderManage');

/*=====  End of Order  ======*/



/*=============================
=            Money            =
=============================*/

$route->get('/user-tool/recharge', 'Frontend\MoneyController@recharge');
$route->get('/user-tool/recharge-manage', 'Frontend\MoneyController@rechargeManage');
$route->get('/user-tool/revenue_expenditure', 'Frontend\MoneyController@revenueExpenditure');
$route->post('/user-tool/recharge-validate', 'Frontend\MoneyController@rechargeValidate');

$route->get('/user-tool/ajax-userT-revenueExpen-manage', 'Frontend\MoneyController@ajaxRevenueExpenManage');

/*=====  End of Money  ======*/


/*=================================
=            Transport            =
=================================*/
$route->get('/user-tool/manage-transport', 'Frontend\TransportController@manageList');


/*=====  End of Transport  ======*/


/*============================
=            Chat            =
============================*/

$route->post('/user-tool/chat-validate', 'Frontend\ChatController@addChat');
$route->get('/user-tool/get-data-chat', 'Frontend\ChatController@getDataChat');

/*=====  End of Chat  ======*/




/**
 * Admin User Tool
 */
$route->get('/admcp', 'Backend\MainController@main');
/*===================================
=            Admin Login            =
===================================*/

$route->get('/admcp/login', 'Backend\UserController@login');
$route->get('/admcp/logout', 'Backend\UserController@logout');
$route->get('/admcp/change-pass', 'Backend\UserController@changePassword');

$route->post('/admcp/validateLogin', 'Backend\UserController@validateLogin');
$route->post('/admcp/handleChangePass', 'Backend\UserController@handleChangePass');

/*=====  End of Admin Login  ======*/

/*=============================
=            Order            =
=============================*/

$route->get('/admcp/order-manage', 'Backend\OrderController@orderManage');
$route->get('/admcp/detail-order/{id}', 'Backend\OrderController@orderDetail');
$route->post('/admcp/update-order', 'Backend\OrderController@updateOrder');

$route->get('/admcp/ajax-admcp-order-manage','Backend\OrderController@ajaxOrderManage');
$route->get('/admcp/price-by-weight','Backend\OrderController@priceByWeight');
$route->post('/admcp/validate-price-by-weight','Backend\OrderController@validateAddPriceWeight');

/*=====  End of Order  ======*/

/*=============================
=            Money            =
=============================*/

$route->get('/admcp/recharge', 'Backend\MoneyController@recharge');
$route->get('/admcp/recharge/{id}', 'Backend\MoneyController@recharge');
$route->get('/admcp/recharge-manage', 'Backend\MoneyController@rechargeManage');
$route->get('/admcp/info-pay', 'Backend\MoneyController@managePay');
$route->get('/admcp/remove-recharge/{id}', 'Backend\MoneyController@removeRecharge');

$route->post('/admcp/recharge-validate', 'Backend\MoneyController@rechargeValidate');
$route->post('/admcp/add-pay-validate', 'Backend\MoneyController@addPayValidate');


/*=====  End of Money  ======*/

/*============================
=            User            =
============================*/

$route->get('/admcp/user-manage', 'Backend\UsersController@userManage');
$route->get('/admcp/user-edit/{id}', 'Backend\UsersController@userEdit');

$route->post('/admcp/edit-user-validate', 'Backend\UsersController@editUserValidate');
$route->get('/admcp/user-delete/{id}','Backend\UsersController@deleteUser' );

$route->get('/admcp/notice-manage', 'Backend\UsersController@noticeManage');
$route->get('/admcp/notice-delete/{id}','Backend\UsersController@deleteNotice' );

/*=====  End of User  ======*/

/*============================
=            Page            =
============================*/

$route->get('/admcp/page-manage', 'Backend\PagesController@pageManage');
$route->get('/admcp/menu-manage', 'Backend\PagesController@menuManage');
$route->get('/admcp/page-add', 'Backend\PagesController@handlePage');
$route->get('/admcp/page-edit/{id}', 'Backend\PagesController@handlePage');

$route->post('/admcp/validate-page', 'Backend\PagesController@validatePage');
$route->get('/admcp/page-delete/{id}','Backend\PagesController@deletePage' );

/*=====  End of Page  ======*/

/*============================
=            Chat            =
============================*/

$route->post('/admcp/chat-validate', 'Backend\ChatController@addChat');
$route->get('/admcp/get-data-chat', 'Backend\ChatController@getDataChat');

/*=====  End of Chat  ======*/