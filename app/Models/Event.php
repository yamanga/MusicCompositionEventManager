<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'detail',
        'participate',
        'submit',
        'organizer_id'
    ];


    /**
     * Get the user that owns the Event
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }
    /**
     * Get all of the comments for the Event
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function submits(): HasMany
    {
        return $this->hasMany(Submit::class);
    }
    /**
     * The participants that belong to the Event
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_participants', 'event_id', 'participant_id');
    }

}
