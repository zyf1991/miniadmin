<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Altercustom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('custom', function (Blueprint $table) {
            $table->string('session_key')->nullable()->comment("wxsessionkey");
            //$table->sting('session_key_expire');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('custom', function (Blueprint $table) {
            //
        });
    }
}
