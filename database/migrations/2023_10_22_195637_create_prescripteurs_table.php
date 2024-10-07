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
        Schema::create('prescripteurs', function (Blueprint $table) {
            $table->id('id');
            $table->string('libelle');
            $table->string('logo')->nullable();
            $table->string('titre_responsable')->nullable();
            $table->string('nom_responsable');
            $table->string('phone_responsable');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('prescripteurs');
    }
};
