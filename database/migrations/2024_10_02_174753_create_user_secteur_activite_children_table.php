<?php

use App\Models\SecteurActiviteChildren;
use App\Models\UserSecteurActivite;
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
        Schema::create('user_secteur_activite_children', function (Blueprint $table) {
            $table->id();

            // Spécifier explicitement la table pour la clé étrangère
            $table->foreignId('user_secteur_activite_id');

            // Spécifier explicitement la table pour la clé étrangère
            $table->foreignId('secteur_activite_children_id');

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
        Schema::dropIfExists('user_secteur_activite_children');
    }
};
