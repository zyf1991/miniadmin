<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AuthController as BaseAuthController;
use Encore\Admin\Layout\Content;
use App\Models\Course;

use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Show;
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
     * Create interface.
     *
     * @return Content
     */
    public function edit($id,Content $content)
    {
        $content->header('编辑课程');
        $content->description('编辑课程');
        $content->body($this->form()->edit($id));

        return $content;
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        $content->header('编辑课程');
        $content->description('编辑课程');
        $content->body($this->detail($id));
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Course::findOrFail($id));
        //return redirect("/admin/course/index");
        return $show;
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
        $grid->column('video_cover','课程封面')->image();
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
        $postion=[
            1=>'首页顶部',
            2=>'首页底部',
            3=>'我的页面'
        ];
        $form->select('class_id', '课程分类')->options($category);
        $form->text('name', '课程名称')->required();
        $form->file('c_video', '上传课程')->required()->placeholder('请上传视频');
        $form->image('video_cover', '课程封面')->required();
        $form->textarea('video_desc', '课程描述');
        $form->select('showpostion', '固定位置')->options($postion);
        $form->select('shelf', '上架类型')->default(0)->options($shelf);
        $form->datetime('shelftime','上架时间')->format('YYYY-MM-DD HH:mm:ss')->default("2020-04-01");
        $form->radio('saletype','售卖方式')->options(['0' => '免费', '1'=> '付费'])->default('0');
        $form->currency('saleprice','售卖价格')->symbol('￥')->default('0.00');
        $form->radio('trysee','是否试看')->options(['0' => '否', '1'=> '是'])->default('0');


        // 两个时间显示
        $form->display('created_at', '创建时间');
        $form->display('updated_at', '修改时间');

        return $form;

    }

    public function store(Request $request)
    {
        $data = $request->all();

        if(isset($data['c_video'])){
            $data['c_video']=env('RESOURCE_APP_URL').$request->file('c_video')->store(config('admin.upload.directory.file'), 'public');
        }
        if(isset($data['video_cover'])){
            $data['video_cover']=env('RESOURCE_APP_URL').$request->file('video_cover')->store(config('admin.upload.directory.image'), 'public');
        }


        $coursemodel = new Course();
        $coursemodel->fill($data);
        $coursemodel->save();
    }

    public function update(Request $request,$id)
    {
        $request_data = $request->all();

        if(isset($request_data['c_video'])){
            $request_data['c_video']=env('RESOURCE_APP_URL').$request->file('c_video')->store(config('admin.upload.directory.file'), 'public');
        }
        if(isset($request_data['video_cover'])){
            $request_data['video_cover']=env('RESOURCE_APP_URL').$request->file('video_cover')->store(config('admin.upload.directory.image'), 'public');
        }
        $coursemodel = new Course();
        $data =$coursemodel->fill($request_data);
        //dd($data);
        //dd($data);
        $result = Course::where('id',$id)->update($data->toArray());

        return redirect("/admin/course/index?per_page".$request->per_page);
        //dd($data);
    }
}
