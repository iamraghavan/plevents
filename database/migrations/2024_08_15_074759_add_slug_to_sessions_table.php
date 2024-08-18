<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('sessions_events', function (Blueprint $table) {
            if (!Schema::hasColumn('sessions_events', 'slug')) {
                $table->string('slug')->unique()->after('title');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sessions_events', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};