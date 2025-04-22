<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class EventModel extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'events';

    // Laravel will automatically set primary key as 'id'
    // if you want to rename your primary key, you should apply these
    protected $primaryKey = 'event_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'event_title',
        'event_venue',
        'event_audience',
        'event_date',
        'event_time_start',
        'event_time_end',
        'event_organizer',
        'event_visitor',
        'event_description',
        'event_privacy',
        'event_images',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
