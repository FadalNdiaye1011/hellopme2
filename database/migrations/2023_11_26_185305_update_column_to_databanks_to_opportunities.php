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
            $table->dropColumn('attachement_1');
            $table->dropColumn('attachement_2');
            $table->dropColumn('attachement_3');
        });

        Schema::table('databanks', function (Blueprint $table) {
            $table->integer('secteur_activite_children_id')->nullable()->after('pays_partner_id');
            $table->integer('prescripteur_id')->nullable()->after('pays_partner_id');
            $table->integer('type_opportunity_id')->change();
            $table->dropColumn('attachement_1');
            $table->dropColumn('attachement_2');
            $table->dropColumn('attachement_3');
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
            $table->string('attachement_1');
            $table->string('attachement_2');
            $table->string('attachement_3');
        });

        Schema::table('databanks', function (Blueprint $table) {
            $table->dropColumn('prescripteur_id');
            $table->dropColumn('secteur_activite_children_id');
            $table->string('type_opportunity_id')->change();
            $table->string('attachement_1');
            $table->string('attachement_2');
            $table->string('attachement_3');
        });
       
    }
};
