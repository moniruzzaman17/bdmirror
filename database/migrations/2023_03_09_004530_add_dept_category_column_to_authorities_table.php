<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeptCategoryColumnToAuthoritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('authorities', function (Blueprint $table) {
            $table->integer('dept_category')->unsigned()
            ->after('designation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('authorities', function (Blueprint $table) {
            $table->dropColumn('dept_category');
        });
    }
}
