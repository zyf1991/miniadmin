<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Addcourse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course', function (Blueprint $table) {
            $table->increments('id')->comment('id');
            $table->integer('class_id')->nullable($value = true)->comment('栏目id');
            $table->string('name', 255)->comment('课程名称');
            $table->string('c_video', 255)->comment('课程视频');
            $table->string('video_cover', 255)->nullable($value = true)->comment('课程封面');
            $table->string('video_desc', 255)->nullable($value = true)->comment('课程描述');
            $table->tinyInteger('trysee')->default(0)->comment('课程试看 0否 1是');
            $table->tinyInteger('shelf')->default(0)->comment('上架类型 0立即 1定时 2暂不');
            $table->dateTime('shelftime')->nullable($value = true)->comment('上架时间');
            $table->tinyInteger('saletype')->default(0)->comment('售卖方式0免费 1付费');
            $table->tinyInteger('salesetting')->default(0)->comment('售卖设置0免费 1付费');
            $table->unsignedDecimal('saleprice', 8,2)->default(0.00)->comment('售卖价格');
            $table->unsignedDecimal('delprice', 8,2)->default(0.00)->comment('划线价格');
            $table->integer('showpostion')->nullable($value = true)->comment('展示位置');

            $table->index('id');
            $table->index('class_id');
            $table->index('name');
            $table->index('shelftime');
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course', function (Blueprint $table) {
            //
        });
    }
}
