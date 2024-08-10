<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTableRoles extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Allow NULL values or set a default value
            $table->string('roles')->nullable()->change(); // or ->default('user')->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Revert the changes if needed
            $table->string('roles')->nullable(false)->change(); // or ->default(null)->change();
        });
    }
}