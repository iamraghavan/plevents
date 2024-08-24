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
            $table->string('registration_id')->unique();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->string('google_uid');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('address');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('pincode');
            $table->decimal('amount', 10, 2); // Store amount in decimal format
            $table->string('payment_id')->nullable();
            $table->string('order_id')->nullable();
            $table->string('invoice_id')->nullable();
            $table->string('payment_method')->nullable();
            $table->timestamp('transaction_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_registrations');
    }
}