<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan', function (Blueprint $table) {
            $table->increments('id')->comment('id');
            $table->integer('c_id')->comment('客户id');
            $table->string('plan_title', 255)->comment('计划标题');
            $table->string('plan_desc', 255)->comment('计划描述');
            $table->dateTime('plan_stime')->comment('计划时间');
            $table->dateTime('plan_etime')->comment('计划结束时间');
            $table->dateTime('sys_etime')->comment('系统计算结束计划时间');
            $table->tinyInteger('plan_type')->comment('计划类型');

            $table->index(['id', 'c_id']);
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
        //Schema::dropIfExists('plan');
    }
}
