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
            $table->string('name', 255)->comment('名字');
            $table->string('wxname', 60)->comment('微信名字');
            $table->unsignedMediumInteger('sex')->comment('性别');
            $table->unsignedInteger('age')->comment('年龄');
            $table->string('cardId', 18)->comment('身份证号');
            $table->date('birth')->comment('出生日');
            $table->json('tag')->comment('标签');
            $table->index('id');
            $table->unique('cardId');
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
