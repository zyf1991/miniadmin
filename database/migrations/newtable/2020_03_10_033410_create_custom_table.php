<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom', function (Blueprint $table) {
            $table->increments('id')->comment('id');
            $table->string('name', 255)->nullable($value = true)->comment('名字');
            $table->string('wxname', 255)->comment('微信名字');
            $table->unsignedMediumInteger('gender')->default(0)->comment('性别');
            $table->unsignedInteger('age')->default(0)->comment('年龄');
            $table->char('cardid', 18)->nullable($value = true)->comment('身份证号');
            $table->date('birth')->nullable($value = true)->comment('出生日');
            $table->json('tag')->nullable($value = true)->comment('标签');
            $table->string("avatarurl")->nullable($value = true)->comment('用户头像');
            $table->string("province")->nullable($value = true)->comment('用户省份');
            $table->string("city")->nullable($value = true)->comment('用户城市');
            $table->string("openid",255)->default(0)->comment('微信openid');


            $table->index('id');
            $table->unique('cardId');
            $table->unique('openid');
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
        //Schema::dropIfExists('custom');
    }
}
