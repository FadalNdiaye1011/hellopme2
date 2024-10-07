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
        Schema::table('databanks', function($table) {
            $table->dropColumn('status');
            $table->dropColumn('secteur_activite_children_id');
            $table->dropColumn('prescripteur_id');
            $table->string('detail_page_url_selector')->nullable();
            $table->string('detail_page_content_selector')->nullable();
        });

        Schema::table('website_links', function($table) {
            $table->string('detail_page_content_selector')->nullable();
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
            $table->string('status');
            $table->integer('prescripteur_id');
            $table->integer('secteur_activite_children_id');
            $table->dropColumn('detail_page_url_selector');
            $table->dropColumn('detail_page_content_selector');
        });
    }
};
