<?php

namespace Encore\Admin\Auth\Database;

use Illuminate\Database\Seeder;

class AdminTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create a user.
        Administrator::truncate();
        Administrator::create(
            [
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'name' => 'Administrator',
            ]
        );

        // create a role.
        Role::truncate();
        Role::create(
            [
                'name' => 'Administrator',
                'slug' => 'administrator',
            ]
        );

        // add role to user.
        Administrator::first()->roles()->save(Role::first());

        //create a permission
        Permission::truncate();
        Permission::insert(
            [
                [
                    'name' => '超级管理员',
                    'slug' => '*',
                    'http_method' => '',
                    'http_path' => '*',
                ],
                [
                    'name' => '',
                    'slug' => '系统管理',
                    'http_method' => 'GET',
                    'http_path' => '/',
                ],
                [
                    'name' => '登陆',
                    'slug' => 'auth.login',
                    'http_method' => '',
                    'http_path' => "/auth/login\r\n/auth/logout",
                ],
                [
                    'name' => '用户管理',
                    'slug' => 'auth.setting',
                    'http_method' => 'GET,PUT',
                    'http_path' => '/auth/setting',
                ],
                [
                    'name' => '操作日志',
                    'slug' => 'auth.management',
                    'http_method' => '',
                    'http_path' => "/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs",
                ],
            ]
        );

        Role::first()->permissions()->save(Permission::first());

        // add default menus.
        Menu::truncate();
        Menu::insert(
            [
                [
                    'parent_id' => 0,
                    'order' => 1,
                    'title' => '系统管理',
                    'icon' => 'fa-bar-chart',
                    'uri' => '/',
                ],
                [
                    'parent_id' => 0,
                    'order' => 2,
                    'title' => '管理员管理',
                    'icon' => 'fa-tasks',
                    'uri' => '',
                ],
                [
                    'parent_id' => 3,
                    'order' => 3,
                    'title' => '用户管理',
                    'icon' => 'fa-users',
                    'uri' => 'auth/users',
                ],
                [
                    'parent_id' => 3,
                    'order' => 4,
                    'title' => '角色管理',
                    'icon' => 'fa-user',
                    'uri' => 'auth/roles',
                ],
                [
                    'parent_id' => 3,
                    'order' => 5,
                    'title' => '权限管理',
                    'icon' => 'fa-ban',
                    'uri' => 'auth/permissions',
                ],
                [
                    'parent_id' => 3,
                    'order' => 6,
                    'title' => '菜单管理',
                    'icon' => 'fa-bars',
                    'uri' => 'auth/menu',
                ],
                [
                    'parent_id' => 3,
                    'order' => 7,
                    'title' => '操作日志',
                    'icon' => 'fa-history',
                    'uri' => 'auth/logs',
                ],
            ]
        );

        // add role to menu.
        Menu::find(2)->roles()->save(Role::first());
    }
}
