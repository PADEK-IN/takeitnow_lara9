<?php

namespace App\Models;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['id_user', 'id_event', 'rating', 'comment'];

    public function getHashidAttribute()
    {
        return Hashids::encode($this->id);
    }

    public function eventData(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'id_event');
    }

    public function userData(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
