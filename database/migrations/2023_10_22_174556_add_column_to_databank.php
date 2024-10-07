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
        Schema::table('databanks', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->integer('type_opportunity_id')->after('phone_contact');
            $table->integer('secteur_activite_children_id')->after('phone_contact');
            $table->text('detail')->after('description');
            $table->text('status')->after('detail');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('databanks', function (Blueprint $table) {
            $table->dropColumn('type_opportunity_id');
            $table->dropColumn('secteur_activite_children_id');
            $table->dropColumn('detail');
            $table->dropColumn('status');
        });
    }
};
