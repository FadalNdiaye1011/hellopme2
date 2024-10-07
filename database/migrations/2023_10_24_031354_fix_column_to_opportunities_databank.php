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
        Schema::table('opportunities', function (Blueprint $table) {
            $table->text('titre')->change();
            $table->dropColumn('started_at');
            $table->dropColumn('deadline');
            $table->integer('budget')->change();
        });

        Schema::table('databanks', function (Blueprint $table) {
            $table->text('titre')->change();
            $table->dropColumn('started_at');
            $table->dropColumn('deadline');
            $table->integer('budget')->change();      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('opportunities', function (Blueprint $table) {

        });

        Schema::table('databanks', function (Blueprint $table) { 

        });
    }
};
