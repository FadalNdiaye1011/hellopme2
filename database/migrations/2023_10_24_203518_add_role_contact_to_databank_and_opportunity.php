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
        Schema::table('databanks', function (Blueprint $table) {
            $table->string('role_contact')->after('nom_contact')->nullable();
        });

        Schema::table('opportunities', function (Blueprint $table) {
            $table->string('role_contact')->after('nom_contact')->nullable();
            // $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('databanks', function (Blueprint $table) {
            $table->dropColumn('role_contact');
        });

        Schema::table('opportunities', function (Blueprint $table) {
            $table->dropColumn('role_contact');
        });
    }
};
