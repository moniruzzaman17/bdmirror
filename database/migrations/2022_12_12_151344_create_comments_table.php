<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('citizen_id')->unsigned();
            $table->foreign('citizen_id')->references('id')->on('citizens')->onDelete('cascade');
            $table->integer('authority_id')->unsigned();
            $table->foreign('authority_id')->references('id')->on('authorities')->onDelete('cascade');
            $table->integer('complaint_id')->unsigned();
            $table->foreign('complaint_id')->references('id')->on('complaints')->onDelete('cascade');
            $table->text('details')->nullable();
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
        Schema::dropIfExists('comments');
    }
}
