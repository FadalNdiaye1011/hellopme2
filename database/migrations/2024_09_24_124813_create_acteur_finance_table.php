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
        Schema::create('acteur_finances', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string("photo")->nullable();
            $table->string("ville")->nullable();
            $table->string("website")->nullable();
            $table->longText("declaration");
            $table->unsignedBigInteger('type_finance_id');
            $table->unsignedBigInteger('pays_partners_id');
            $table->foreign('type_finance_id')->references('id')->on('type_finances')->onDelete('cascade');
            $table->foreign('pays_partners_id')->references('id')->on('pays_partners')->onDelete('cascade');
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
        Schema::dropIfExists('acteur_finance');
    }
};
