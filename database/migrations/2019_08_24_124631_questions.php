<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Questions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Questions', function (Blueprint $table) {
        $table->increments('id')->unsigned();
        $table->integer('category_id')->unsigned();
        $table->text('question');
        $table->foreign('category_id')->references('id')->on('Categories')->onDelete('cascade');;
      });
    }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::dropIfExists('Questions');
  }
}
