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
            $table->text('image_url')->nullable()->after('description');
            $table->string('attachement_1')->nullable();
            $table->string('attachement_2')->nullable();
            $table->string('attachement_3')->nullable();
        });

        Schema::table('opportunities', function (Blueprint $table) {
            $table->text('image_url')->change();
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
            $table->dropColumn('image_url');
            $table->dropColumn('attachement_1')->nullable();
            $table->dropColumn('attachement_2')->nullable();
            $table->dropColumn('attachement_3')->nullable();
        });
    }
};
