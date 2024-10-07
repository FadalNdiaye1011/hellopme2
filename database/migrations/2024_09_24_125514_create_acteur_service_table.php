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
        Schema::create('acteur_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('acteur_finance_id');
            $table->unsignedBigInteger('service_id');
            $table->text('commentaire')->nullable();  // Ajout du champ commentaire
            $table->foreign('acteur_finance_id')->references('id')->on('acteur_finances')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
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
        Schema::dropIfExists('acteur_service');
    }
};
