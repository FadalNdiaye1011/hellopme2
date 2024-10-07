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
        Schema::table('secteur_activites', function (Blueprint $table) {
            $table->string('image')->after('id')->nullable();
        });

        Schema::table('secteur_activite_children', function (Blueprint $table) {
            $table->string('image')->after('id')->nullable();
        });

        Schema::table('type_opportunities', function (Blueprint $table) {
            $table->string('image')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('secteur_activites', function (Blueprint $table) {
            $table->dropColumn('image');
        });

        Schema::table('secteur_activite_children', function (Blueprint $table) {
            $table->dropColumn('image');
        });

        Schema::table('type_opportunities', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};
