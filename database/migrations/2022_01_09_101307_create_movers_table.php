<?php

use Brick\Math\BigInteger;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movers', function (Blueprint $table) {
            $table->id();
            $table->string('ccode');
            $table->string('name');
            $table->string('email');
            $table->bigInteger('pnumber');
            $table->string('apttype');
            $table->string('movingtype');
            $table->integer('apartmentNo');
            $table->string('moverscompany');
            $table->string('movingItems');
            $table->string('permissionStatus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movers');
    }
}
