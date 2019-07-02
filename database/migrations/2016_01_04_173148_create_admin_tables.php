<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function getConnection()
    {
        return config('admin.database.connection') ?: config('database.default');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            config('admin.database.users_table'),
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('username', 190)->unique();
                $table->string('password', 60);
                $table->string('name');
                $table->string('avatar')->nullable();
                $table->string('remember_token', 100)->nullable();
                $table->timestamps();
            }
        );

        Schema::create(
            config('admin.database.roles_table'),
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 50)->unique();
                $table->string('slug', 50)->unique();
                $table->timestamps();
            }
        );

        Schema::create(
            config('admin.database.permissions_table'),
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 50)->unique();
                $table->string('slug', 50)->unique();
                $table->string('http_method')->nullable();
                $table->text('http_path')->nullable();
                $table->timestamps();
            }
        );

        Schema::create(
            config('admin.database.menu_table'),
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('parent_id')->default(0);
                $table->integer('order')->default(0);
                $table->string('title', 50);
                $table->string('icon', 50);
                $table->string('uri', 50)->nullable();
                $table->string('permission')->nullable();

                $table->timestamps();
            }
        );

        Schema::create(
            config('admin.database.role_users_table'),
            function (Blueprint $table) {
                $table->integer('role_id');
                $table->integer('user_id');
                $table->index(['role_id', 'user_id']);
                $table->timestamps();
            }
        );

        Schema::create(
            config('admin.database.role_permissions_table'),
            function (Blueprint $table) {
                $table->integer('role_id');
                $table->integer('permission_id');
                $table->index(['role_id', 'permission_id']);
                $table->timestamps();
            }
        );

        Schema::create(
            config('admin.database.user_permissions_table'),
            function (Blueprint $table) {
                $table->integer('user_id');
                $table->integer('permission_id');
                $table->index(['user_id', 'permission_id']);
                $table->timestamps();
            }
        );

        Schema::create(
            config('admin.database.role_menu_table'),
            function (Blueprint $table) {
                $table->integer('role_id');
                $table->integer('menu_id');
                $table->index(['role_id', 'menu_id']);
                $table->timestamps();
            }
        );

        Schema::create(
            config('admin.database.operation_log_table'),
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->string('path');
                $table->string('method', 10);
                $table->string('ip');
                $table->text('input');
                $table->index('user_id');
                $table->timestamps();
            }
        );
        Schema::create(
            'system_config',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title')->default('PFinal社区')->comment('网站标题');
                $table->string('keywords')->default('PFinal社区')->comment('网站关键字');
                $table->string('description')->default(
                    'pfinalClub 致力于提供优质PHP中文学习资源,Laravel、Yii、ThinkPHP等框架学习资源、中文视频教程、项目实战教程'
                )->comment('站点描述');
                $table->string('logo')->default('logo.jpg')->comment('站点logo');
                $table->unsignedInteger('template_id')->default(0)->index()->comment('模板id');
                $table->timestamps();
            }
        );
        Schema::create(
            'modules',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title')->comment('模块名称');
                $table->string('name')->unique()->comment('模块标识');
                $table->string('version')->comment('版本号');
                $table->tinyInteger('local')->comment('本地模块');
                $table->tinyInteger('is_nav')->default(0)->comment('是否显示导航');
                $table->tinyInteger('status')->default(0)->comment('是否上线');
                $table->text('package')->comment('模块配置');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('admin.database.users_table'));
        Schema::dropIfExists(config('admin.database.roles_table'));
        Schema::dropIfExists(config('admin.database.permissions_table'));
        Schema::dropIfExists(config('admin.database.menu_table'));
        Schema::dropIfExists(config('admin.database.user_permissions_table'));
        Schema::dropIfExists(config('admin.database.role_users_table'));
        Schema::dropIfExists(config('admin.database.role_permissions_table'));
        Schema::dropIfExists(config('admin.database.role_menu_table'));
        Schema::dropIfExists(config('admin.database.operation_log_table'));
        Schema::dropIfExists('system_config');
        Schema::dropIfExists('table_modules');
    }
}
