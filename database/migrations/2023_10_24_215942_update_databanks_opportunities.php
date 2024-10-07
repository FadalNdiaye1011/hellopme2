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
            $table->renameColumn('phone_contact', 'email_contact');
            $table->string('lieu')->nullable()->after('budget');
            $table->dropColumn('detail');
        });

        Schema::table('databanks', function (Blueprint $table) {
            $table->renameColumn('phone_contact', 'email_contact');
            $table->dropColumn('detail');
            $table->text('budget')->change();
            $table->string('lieu')->nullable()->after('budget');
            $table->text('started_at')->change();
            $table->text('deadline')->change();
            $table->text('deadline_question')->change();
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
            $table->renameColumn('email_contact', 'phone_contact');
            $table->dropColumn('lieu');
            $table->text('detail');
        });

        Schema::table('databanks', function (Blueprint $table) {
            $table->renameColumn('email_contact', 'phone_contact');
            $table->text('detail');
            $table->text('budget')->change();
            $table->text('started_at')->change();
            $table->text('deadline')->change();
            $table->text('deadline_question')->change();
        });

    }
};
