<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AuthController as BaseAuthController;
use Encore\Admin\Layout\Content;
use App\Models\Course;

use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Illuminate\Http\Request;

class CourseController extends BaseAuthController
{
    /**
     * Index interface.
     *
     * @return Content
     */
    public function index(Content $content)
    {

        $content->header('课程管理');
        $content->description('课程管理');
        $content->body($this->grid());

        return $content;
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create(Content $content)
    {
        $content->header('增加课程');
        $content->description('增加课程');
        $content->body($this->form());

        return $content;
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $category = [
            1 => '心理',
            2 => '法律',
            3 => '理财',
        ];

        $grid = new Grid(new Course);
        $grid->column('id', 'ID')->sortable();
        $grid->column('class_id','分类')->using($category);;
        $grid->column('name','名称');
        $grid->column('c_video','课程地址')->link()->copyable();
        $grid->column('video_cover','课程封面');
        $grid->column('video_desc','课程描述');
        $grid->column('saleprice','课程价格');
        $grid->column('trysee','是否支持试看')->using([
            1 => '是',
            0 => '否'
        ], '未知')->dot([
            1 => 'danger',
            0 => 'info'
        ], 'warning');;
        $grid->column('saletype','售卖方式')->using([0=>'免费',1=>'付费'])->label([
            0 => 'default',
            1 => 'warning'
        ]);

        //$grid->column('video_desc','课程描述');

        return $grid;
    }

    protected function form()
    {
        $form = new Form(new Course);

        // 添加text类型的input框
        $category = [
            1 => '心理',
            2 => '法律',
            3 => '理财',
        ];

        $shelf= [
            0 => '立即',
            1 => '定时',
            2 => '暂定' ,
        ];
        $form->select('class_id', '课程分类')->options($category);
        $form->textarea('name', '课程名称');
        $form->file('c_video', '上传课程');
        //$form->file('video_cover', '课程封面');
        //$form->image('video_desc', '课程描述');

        $form->select('shelf', '上架类型')->default(0)->options($shelf);
        //$form->switch('trysee', '是否试看');

        // 两个时间显示
        $form->display('created_at', '创建时间');
        $form->display('updated_at', '修改时间');

        return $form;

    }

    public function store(Request $request)
    {
        $data = $request->all();

        if(isset($data['c_video'])){
            $data['c_video']=env("RESOURCE_APP_URL").'videos/'.$request->file('c_video')->store(config('admin.upload.directory.file'), 'public');
        }

        $coursemodel = new Course();
        $coursemodel->fill($data);
        $coursemodel->save();
    }
}
