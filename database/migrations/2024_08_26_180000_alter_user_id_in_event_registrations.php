<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserIdInEventRegistrations extends Migration
{
    public function up()
    {
        Schema::table('event_registrations', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['user_id']);
        });

        Schema::table('event_registrations', function (Blueprint $table) {
            // Change the column type
            $table->string('user_id', 225)->change();
        });

        Schema::table('event_registrations', function (Blueprint $table) {
            // Recreate the foreign key constraint
            $table->foreign('user_id')->references('google_uid')->on('users');
        });
    }

    public function down()
    {
        Schema::table('event_registrations', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['user_id']);
        });

        Schema::table('event_registrations', function (Blueprint $table) {
            // Revert the column type
            $table->bigInteger('user_id')->unsigned()->change();
        });

        Schema::table('event_registrations', function (Blueprint $table) {
            // Recreate the foreign key constraint
            $table->foreign('user_id')->references('google_uid')->on('users');
        });
    }
}
