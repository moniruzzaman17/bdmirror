<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('citizen_id')->unsigned();
            $table->foreign('citizen_id')->references('id')->on('citizens')->onDelete('cascade');
            $table->string('type')->nullable();
            $table->string('title')->nullable();
            $table->longText('details')->nullable();
            $table->integer('division')->unsigned()->nullable();
            $table->integer('district')->unsigned()->nullable();
            $table->integer('upazila')->unsigned()->nullable();
            $table->integer('position')->unsigned()->nullable();
            $table->integer('visibility')->unsigned()->default(1);
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
        Schema::dropIfExists('complaints');
    }
}
