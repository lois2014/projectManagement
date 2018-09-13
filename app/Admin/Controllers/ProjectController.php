<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Models\Project;
use App\Models\Category;
class ProjectController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('项目列表');
            // $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('编辑');
            // $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('创建');
            // $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Project::class, function (Grid $grid) {
            $grid->disableExport();
            $grid->id('ID')->sortable();
            $grid->title('标题');
            $grid->population('常住人口');
            $grid->investor('供应商');
            $grid->size('规模');
            $grid->address('地址');
            $grid->schedule('进度');
            $grid->status_text('状态');
            $grid->category_text('分类');
            $grid->area_text('地区');
            $grid->remark('备注');
            $states = [
                'on' => ['text' => 'YES', 'value' => '1'],
                'off' => ['text' => 'NO', 'value' => '0'],
            ];
            $grid->release('是否发布')->switch($states);
            $grid->created_at('创建时间');
            $grid->updated_at('更新时间');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Project::class, function (Form $form) {
            $states = [
                'on' => ['text' => 'YES', 'value' => '1'],
                'off' => ['text' => 'NO', 'value' => '0'],
            ];
            // $form->ignore(['city', 'province']);
            $form->display('id', 'ID');
            $form->text('title', '名称')->rules('required');
            $form->text('investor', '供应商');
            $form->text('schedule', '进度');
            $form->text('size', '规模');
            $form->number('population', '常住人口(万)');
            $form->select('category_id', '分类')->options(Category::selectOptions());
            $form->select('status', '状态')->options(Project::$statusText);
            $form->select('province', '省')->options('/admin/provinces')->load('city', '/admin/cities');
            $form->select('city', '市')->load('area_code', '/admin/areas');
            $form->select('area_code', '县/区');
            $form->text('address', '详细地址');
            $states = [
                'on' => ['text' => 'YES', 'value' => '1'],
                'off' => ['text' => 'NO', 'value' => '0'],
            ];
            $form->switch('release', '是否发布')->options($states);
            $form->textarea('remark', '备注');
            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }
}
