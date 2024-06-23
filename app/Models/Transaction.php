<?php

namespace App\Models;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['id_user', 'id_event', 'quantity', 'proof', 'status', 'isValid'];

    public function getHashidAttribute()
    {
        return Hashids::encode($this->id);
    }

    public function userData(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function eventData(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'id_event');
    }
}
