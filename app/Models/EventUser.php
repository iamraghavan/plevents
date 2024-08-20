<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventUser extends Model
{
    use HasFactory;
    protected $table = 'events_users';
    protected $fillable = [
        'local_uid',
        'first_name',
        'last_name',
        'email',
        'profile_picture',
        'google_uid',
    ];
}
