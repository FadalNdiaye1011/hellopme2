<?php

use App\Models\SecteurActivite;
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
        Schema::create('user_secteur_activite', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class,"user_id")->constrained()->onDelete('cascade');
            $table->foreignIdFor(SecteurActivite::class,"secteur_activite_id")->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('user_secteur_activite');
    }
};
