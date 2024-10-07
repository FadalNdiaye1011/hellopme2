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
        Schema::table('website_links', function (Blueprint $table) {
            $table->dropColumn('type_selector');
            $table->dropColumn('nom_client_selector');
            $table->dropColumn('budget_selector');
            $table->dropColumn('started_at_selector');
            $table->dropColumn('deadline_selector');
            $table->integer('type_opportunity_id')->nullable();
            $table->integer('prescripteur_id')->nullable();
            $table->integer('pays_partner_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('website_links', function (Blueprint $table) {
            $table->string('type_selector')->nullable();
            $table->string('nom_client_selector')->nullable();
            $table->string('budget_selector')->nullable();
            $table->string('started_at_selector')->nullable();
            $table->string('deadline_selector')->nullable();
            $table->dropColumn('type_opportunity_id');
            $table->dropColumn('prescripteur_id');
            $table->dropColumn('pays_partner_id');
        });
    }
};
