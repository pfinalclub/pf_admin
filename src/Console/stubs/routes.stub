<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
	 // 前台站点管理
    $router->get('reception_system','WebSystemController@index')->name('web.index');
    $router->post('reception_system/config_up','WebSystemController@config_up');

    // 模块管理
    $router->resource('modules','ModuleController');
    //模块路由处理
    //Module::routes();
});
