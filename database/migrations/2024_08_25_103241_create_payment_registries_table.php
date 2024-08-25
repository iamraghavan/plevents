<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentRegistriesTable extends Migration
{
    public function up()
    {
        Schema::create('payment_registry', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_registration_id');
            $table->string('payment_id')->nullable();
            $table->string('order_id')->nullable();
            $table->string('invoice_id')->unique();
            $table->string('payment_method')->nullable(); // New column for payment method
            $table->timestamp('payment_time')->nullable(); // New column for payment time
            $table->json('payment_data')->nullable(); // New column for payment data
            $table->timestamps();

            $table->foreign('event_registration_id')->references('id')->on('event_registrations')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_registry');
    }
}