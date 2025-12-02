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

    // All users regardless of status
    public function users()
    {
        return $this->belongsToMany(User::class, 'event_user')
                    ->withPivot('status')
                    ->withTimestamps();
    }

    // Badge relationship
    public function badge()
    {
        return $this->belongsTo(Badge::class);
    }

    // Only users who have joined (not cancelled)
    public function joinedUsers()
    {
        return $this->belongsToMany(User::class, 'event_user')
                    ->wherePivot('status', 'joined')
                    ->withTimestamps();
    }

    // Users who joined OR completed (for counting volunteers)
    public function activeUsers()
    {
        return $this->belongsToMany(User::class, 'event_user')
                    ->whereIn('event_user.status', ['joined', 'completed'])
                    ->withTimestamps();
    }
}