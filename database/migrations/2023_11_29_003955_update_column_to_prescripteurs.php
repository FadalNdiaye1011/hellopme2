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
        Schema::table('prescripteurs', function (Blueprint $table) {
            $table->string('website')->nullable();
            $table->string('town')->nullable();
            $table->unsignedInteger('pays_id')->nullable();
            $table->unsignedInteger('finance_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prescripteurs', function (Blueprint $table) {
            $table->dropColumn('website');
            $table->dropColumn('town');
            $table->dropColumn('pays_id');
            $table->dropColumn('finance_id');
        });
    }
};
