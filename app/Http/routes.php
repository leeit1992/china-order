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

$route->get('/user-tool','Frontend\MainController@main');



/**
 * USER TOOOL
 */

/*============================
=            Cart            =
============================*/

$route->post('/user-tool/addToCartHttp','Frontend\CartController@addToCartHttp');
$route->get('/user-tool/cart','Frontend\CartController@cartManage');
$route->post('/user-tool/updateCart','Frontend\CartController@updateCart');


/*=====  End of Cart  ======*/


/*============================
=            User            =
============================*/

$route->get('/user-tool/login','Frontend\UserController@login');
$route->get('/user-tool/logout','Frontend\UserController@logout');
$route->get('/user-tool/register','Frontend\UserController@register');

$route->post('/user-tool/validateLogin','Frontend\UserController@validateLogin');

/*=====  End of User  ======*/


