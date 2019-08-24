<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('Users', function (Blueprint $table) {
          $table->increments('id')->unsigned();
          $table->string('organization_name');
          $table->string('sector');
          $table->date('date_of_assesment');
          $table->string('internal_external');
          $table->string('password');
          $table->string('user_type')->default('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Users');
    }
}
