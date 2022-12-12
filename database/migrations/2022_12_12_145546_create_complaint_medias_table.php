<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaint_medias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('complaint_id')->unsigned();
            $table->foreign('complaint_id')->references('id')->on('complaints')->onDelete('cascade');
            $table->longText('medias')->nullable();
            $table->longText('additional_medias')->nullable();
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
        Schema::dropIfExists('complaint_medias');
    }
}
