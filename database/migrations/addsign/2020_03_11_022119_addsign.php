<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Addsign extends Migration
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
            $table->string('sign_text',255)->comment('打卡内容');
            $table->json('sign_image',255)->comment('打卡内容');
            //$table->json('sign_image',255)->comment('打卡内容');
            $table->index('id');
            $table->index(['c_id', 'plan_id']);
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
        Schema::table('sign', function (Blueprint $table) {
            //
        });
    }
}
