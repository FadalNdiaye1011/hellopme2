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
            $table->string('status')->nullable()->change();
            $table->string('secteur_activite_children_id')->nullable()->change();;
            $table->string('type_opportunity_id')->nullable()->change();
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
            $table->string('status')->change();
            $table->string('secteur_activite_children_id')->change();
            $table->string('type_opportunity_id')->change();
        });
    }
};
