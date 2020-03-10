<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('sign', function (Blueprint $table) {
            $table->increments('id')->comment('id');
            $table->integer('c_id')->comment('客户id');
            $table->integer('plan_id')->comment('计划id');
            $table->dateTime('sign_time')->comment('签到时间');
            $table->tinyInteger('is_sign')->comment('是否签到 0未签到 1签到');
            $table->dateTime('plan_etime')->comment('计划结束时间');
            $table->dateTime('sys_etime')->comment('系统计算结束计划时间');
            $table->tinyInteger('plan_type')->comment('计划类型');
            $table->index('id');
            $table->index(['plan_id', 'c_id']);
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
        //Schema::dropIfExists('sign');
    }
}
