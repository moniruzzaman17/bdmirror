<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthoritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authorities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('mobile')->nullable();
            $table->string('organization')->nullable();
            $table->string('designation')->nullable();
            $table->string('official_id')->nullable();
            $table->string('nid')->nullable();
            $table->string('working_division')->nullable();
            $table->string('working_district')->nullable();
            $table->string('working_upazila')->nullable();
            $table->longText('image')->nullable();
            $table->rememberToken();
            $table->integer('is_approved')->unsigned()->default(0);
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
        Schema::dropIfExists('authorities');
    }
}
