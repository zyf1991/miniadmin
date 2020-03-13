<?php

namespace App\Admin\Controllers;

use App\Models\Plan;
use Encore\Admin\Controllers\AuthController as BaseAuthController;
use Encore\Admin\Layout\Content;
use App\Models\Custom;

use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Illuminate\Http\Request;
use Encore\Admin\Widgets\Table;

class CustomController extends BaseAuthController
{
    /**
     * Index interface.
     *
     * @return Content
     */
    public function index(Content $content)
    {

        $content->header('用户管理');
        $content->description('用户管理');
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

        $grid = new Grid(new Custom);
        $grid->column('id', 'ID')->sortable();
       // $grid->column('wxname','微信名称');
        $grid->column('province','省');
        $grid->column('city','城市');

        $grid->column('wxname', '微信抿')->modal('最新评论', function ($model) {
            $comments=[];
            return new Table(['计划内容', '计划描述', '计划时间'], $comments);
        });

        return $grid;
    }

    protected function form()
    {
        $form = new Form(new Custom);



    }

    public function store(Request $request)
    {

    }
}
