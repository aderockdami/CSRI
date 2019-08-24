<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Results extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Results', function (Blueprint $table) {
        $table->increments('id')->unsigned();
        $table->integer('question_id')->unsigned();
        $table->integer('user_id')->unsigned();
        $table->string('response');
        $table->foreign('question_id')->references('id')->on('Questions')->onDelete('cascade');;
        $table->foreign('user_id')->references('id')->on('Users')->onDelete('cascade');;
        });
    }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::dropIfExists('Results');
  }
}
