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
        Schema::create('databanks', function (Blueprint $table) {
            $table->id('id');
            $table->string('titre')->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->string('type')->nullable();
            $table->text('criteres')->nullable();
            $table->string('source')->nullable();
            $table->integer('budget')->nullable();
            $table->string('nom_contact')->nullable();
            $table->string('phone_contact')->nullable();
            $table->integer('prescripteur_id')->nullable();
            $table->integer('pays_partner_id')->nullable();
            $table->unsignedBigInteger('locked_by')->nullable();
            $table->timestamp('locked_at')->nullable();
            $table->foreign('locked_by')->references('id')->on('users')->onDelete('set null');

            // Ajout de la colonne update_by
            $table->unsignedBigInteger('update_by')->nullable();
            $table->foreign('update_by')->references('id')->on('users')->onDelete('set null');

            $table->string('etat')->default('unmodified'); // Valeurs possibles: 'unmodified', 'being_modified', 'modified'
            $table->string('previous_etat')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('deadline_question')->nullable();
            $table->timestamp('deadline')->nullable();
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
        Schema::dropIfExists('databanks');
    }
};
