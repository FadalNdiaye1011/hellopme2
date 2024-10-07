<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('area_of_interest', function (Blueprint $table) {
            $table->string('type');
            $table->integer('expertise_domain_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('area_of_interest', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('expertise_domain_id');
        });
    }
};
