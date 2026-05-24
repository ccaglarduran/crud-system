<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    protected $fillable = ['user_id', 'title', 'description', 'position', 'is_completed'];

    protected $casts = [
        'is_completed' => 'boolean',
    ];

    // Bu görev hangi kullanıcıya ait? (Görevi hazırlayan ilişkisi)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}