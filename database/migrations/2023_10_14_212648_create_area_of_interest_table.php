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
        Schema::create('area_of_interest', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->integer('pays_partner_id')->nullable();
            $table->integer('secteur_activite_id')->nullable();
            $table->integer('opportunity_id')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('area_of_interest');
    }
};
 