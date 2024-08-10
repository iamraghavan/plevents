<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $table = 'sessions_events';

    protected $fillable = [
        'title',
        'description',
        'conducted_by',
        'start_time',
        'end_time',
        'date',
        'location',
        'venue',
        'department',
        'mode',
        'meeting_url',
        'price_type',
        'amount',
    ];
}