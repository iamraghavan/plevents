<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventRegistrationsTable extends Migration
{
    public function up()
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('event_registration_id')->unique();
            $table->foreignId('event_id')->constrained('sessions_events');
            $table->foreignId('user_id')->constrained('users');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('address');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('pincode');
            $table->decimal('amount', 10, 2);
            $table->string('payment_id');
            $table->string('order_id');
            $table->string('invoice_id')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_registrations');
    }
}