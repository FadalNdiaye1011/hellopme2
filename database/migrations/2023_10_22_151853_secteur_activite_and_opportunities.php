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
        Schema::table('opportunities', function (Blueprint $table) {
            $table->integer('secteur_activite_children_id')->after('phone_contact');
            $table->unsignedInteger('type_opportunity_id')->after('phone_contact')->change();
            $table->text('detail')->after('description');
        });

        Schema::table('secteur_activite_children', function (Blueprint $table) {
            $table->integer('secteur_activite_id')->after('libelle');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('opportunities', function (Blueprint $table) {
            $table->dropColumn('secteur_activite_children_id');
            $table->dropColumn('detail');
        });

        Schema::table('secteur_activite_children', function (Blueprint $table) {
            $table->dropColumn('secteur_activite_id');
        });
    }
};
