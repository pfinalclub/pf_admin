<?php
/**
 * Created by PhpStorm.
 * User: 南丞
 * Date: 2019/6/12
 * Time: 14:38
 *
 *
 *                      _ooOoo_
 *                     o8888888o
 *                     88" . "88
 *                     (| ^_^ |)
 *                     O\  =  /O
 *                  ____/`---'\____
 *                .'  \\|     |//  `.
 *               /  \\|||  :  |||//  \
 *              /  _||||| -:- |||||-  \
 *              |   | \\\  -  /// |   |
 *              | \_|  ''\---/''  |   |
 *              \  .-\__  `-`  ___/-. /
 *            ___`. .'  /--.--\  `. . ___
 *          ."" '<  `.___\_<|>_/___.'  >'"".
 *        | | :  `- \`.;`\ _ /`;.`/ - ` : | |
 *        \  \ `-.   \_ __\ /__ _/   .-` /  /
 *  ========`-.____`-.___\_____/___.-`____.-'========
 *                       `=---='
 *  ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
 *           佛祖保佑       永无BUG     永不修改
 *
 */

namespace App\Admin\Controllers;

use App\Model\Modules;
use Encore\Admin\Controllers\AdminController;

use Encore\Admin\Form;
use Encore\Admin\Grid;

class ModuleController extends AdminController
{
    protected $title = '模块管理';
    protected $description = [
        'index' => '模块列表',
    ];

    protected function form()
    {
        $form = new Form(new Modules());
        $form->display('id', 'ID');
        $form->text('title', '模块名称')->rules('required');
        $form->text('name', '模块标识')
            ->creationRules(['required', "unique:modules"])
            ->updateRules(['required', "unique:modules,name,{{id}}"]);
        $form->text('version', '版本号')->rules('required');
        $form->textarea('package', '模块配置')->rules('required');
        $form->hidden('local')->value(1);
        $form->hidden('status')->value(0);
        $form->hidden('is_nav')->value(0);

        return $form;
    }


    protected function grid()
    {
        $status = [
            'on' => ['value' => 0, 'text' => '上线', 'color' => 'success'],
            'off' => ['value' => 1, 'text' => '下线', 'color' => 'danger'],
        ];
        $status_nav = [
            'on' => ['value' => 0, 'text' => '显示', 'color' => 'success'],
            'off' => ['value' => 1, 'text' => '不显示', 'color' => 'danger'],
        ];
        $grid = new Grid(new Modules());

        $grid->column('id', 'ID')->sortable();
        $grid->column('title', '模块名');
        $grid->column('name', '模块标识');
        $grid->column('version', '版本号')->label();
        $grid->column('status', '状态')->switch($status);
        $grid->column('is_nav', '导航显示')->switch($status_nav);
        $grid->column('created_at', trans('admin.created_at'));
        $grid->column('updated_at', trans('admin.updated_at'));
        $grid->actions(
            function (Grid\Displayers\Actions $actions) {
                $actions->disableView();
            }
        );

        return $grid;
    }

    public function update($id)
    {
        $data = request()->all();
        if (!is_null(request()->get('status'))) {
            $status = request()->get('status') === 'on' ? 0 : 1;
            $data['status'] = $status;
        }
        if (!is_null(request()->get('is_nav'))) {
            $is_nav = request()->get('is_nav') === 'on' ? 0 : 1;
            $data['is_nav'] = $is_nav;
        }
        return $this->form()->update($id, $data);
    }
}