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
            $table->text('detail')->nullable()->change();
            $table->timestamp('started_at')->nullable()->default(null)->after('pays_partner_id');
            $table->timestamp('deadline')->nullable()->default(null)->after('started_at');
        });

        Schema::table('databanks', function (Blueprint $table) {
            $table->text('detail')->nullable()->change();
            $table->timestamp('started_at')->nullable()->default(null)->after('pays_partner_id');
            $table->timestamp('deadline')->nullable()->default(null)->after('started_at');
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
