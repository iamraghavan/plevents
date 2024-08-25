<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentRegistry extends Model
{
    protected $table = 'payment_registry';

    // Specify the fillable fields
    protected $fillable = [
        'event_registration_id',
        'payment_id',
        'order_id',
        'invoice_id',
        'payment_method',
        'payment_time',
        'payment_data',
    ];

    // Define relationships

    /**
     * Get the event registration associated with the payment.
     */
    public function eventRegistration()
    {
        return $this->belongsTo(EventRegistrationMod::class, 'event_registration_id');
    }
}