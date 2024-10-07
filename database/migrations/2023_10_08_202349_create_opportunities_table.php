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
        Schema::create('opportunities', function (Blueprint $table) {
            $table->id('id');
            $table->string('titre');
            $table->string('slug');
            $table->text('description');
            $table->string('type');
            $table->text('criteres')->nullable();
            $table->string('source')->nullable();
            $table->integer('budget')->nullable();
            $table->string('nom_contact')->nullable();
            $table->string('phone_contact')->nullable();
            $table->integer('prescripteur_id');
            $table->integer('pays_partner_id');
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
        Schema::drop('opportunities');
    }
};
