<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'location',
        'max_volunteers',
        'badge_id',
        'image', 
    ];

    protected $casts = [
        'event_date' => 'datetime',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('status')->withTimestamps();
    }

    public function badge()
    {
        return $this->belongsTo(Badge::class);
    }

    public function joinedUsers()
    {
        return $this->belongsToMany(User::class)->wherePivot('status', 'joined')->withTimestamps();
    }
}