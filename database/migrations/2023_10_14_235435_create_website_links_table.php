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
        Schema::create('website_links', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('url');
            $table->string('title_selector')->nullable();
            $table->string('content_selector')->nullable();
            $table->string('type_selector')->nullable();
            $table->string('nom_client_selector')->nullable();
            $table->string('budget_selector')->nullable();
            $table->string('started_at_selector')->nullable();
            $table->string('deadline_selector')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('website_links');
    }
};
