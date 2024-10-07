<?php

use App\Models\TypeOpportunity;
use App\Models\User;
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
        Schema::create('user_type_opportunite', function (Blueprint $table) {
            $table->id();

            // Utiliser User::class et TypeOpportunity::class pour créer les clés étrangères
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();

            // Correction ici pour s'assurer que le nom de la table est correct
            $table->foreignIdFor(TypeOpportunity::class)->constrained()->cascadeOnDelete();

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
        Schema::dropIfExists('user_type_opportunite');
    }
};
