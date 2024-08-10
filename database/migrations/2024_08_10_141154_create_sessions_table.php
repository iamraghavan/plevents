<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    public function up()
    {
        Schema::create('sessions_events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('conducted_by');
            $table->time('start_time');
            $table->time('end_time');
            $table->date('date');
            $table->string('location')->nullable();
            $table->string('venue')->nullable();
            $table->string('department')->nullable();
            $table->enum('mode', ['Online', 'Offline', 'Hybrid']);
            $table->string('meeting_url')->nullable();
            $table->enum('price_type', ['Free', 'Idle']);
            $table->decimal('amount', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sessions_events');
    }
}