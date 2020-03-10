<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaymoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saymood', function (Blueprint $table) {
            $table->increments('id')->comment('id');
            $table->integer('c_id')->comment('客户id');
            $table->tinyInteger('type')->comment('说说类型');
            $table->dateTime('release_time')->comment('发布时间');
            $table->tinyInteger('is_del')->comment('1删除 0未删除');
            $table->index('id');
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
        Schema::dropIfExists('saymood');
    }
}
