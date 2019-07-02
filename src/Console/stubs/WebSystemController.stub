<?php
/**
 * Created by PhpStorm.
 * User: 南丞
 * Date: 2019/6/10
 * Time: 15:14
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


use App\Model\SystemConfig;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebSystemController extends AdminController
{

    protected $title = '前台系统管理';

    public function index(Content $content = null)
    {
        $content = $content??new Content();
        return $content
            ->title($this->title)
            ->description('前台系统管理信息管理')
            ->row(
                function (Row $row) {
                    $row->column(
                        12,
                        function (Column $column) {
                            $systemConfigModel = SystemConfig::first();
                            $form = new Form($systemConfigModel);
                            $form->action(admin_base_path('reception_system/config_up'));
                            $form->text('title', '网站标题:')->rules('required');
                            $form->text('keywords', '网站关键字');
                            $form->textarea('description', '网站描述');
                            $form->image('logo', '网站Logo')->move('');
                            $form->hidden('_token')->default(csrf_token());
                            $form->saved(
                                function () {
                                    //alert(123);
                                }
                            );
                            $column->append((new Box('前端系统信息', $form))->style('success'));
                        }
                    );
                }
            );
    }

    public function config_up(Request $request)
    {
        $systemConfigModel = SystemConfig::first();
        if ($request->file('logo')) {
            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $realPath = $file->getRealPath();   //临时文件的绝对路径
            $filename = 'logo/'.date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext;
            Storage::disk('public')->put($filename, file_get_contents($realPath));
            $systemConfigModel->logo = $filename;
        }
        $systemConfigModel->description = $request->input('description');
        $systemConfigModel->title = $request->input('title');
        $systemConfigModel->keywords = $request->input('keywords');
        $res = $systemConfigModel->save();
        if ($res) {

            admin_toastr('更行成功');

            return redirect(url('admin/reception_system'));
        } else {
            admin_error('更新失败');

            return redirect(url('admin/reception_system'));
        }

    }
}