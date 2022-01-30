<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlterForMoversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movers', function ($table) {
            $table->integer('user_incharge')->nullable();
            // $table->foreignId('user_incharge')->references('id')->on('users')->nullable();
        });
    }
    //  $table->foreignId('user_incharge')->references('id')->on('users')->nullable();
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alter_for_movers');
    }
}
