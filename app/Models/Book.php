<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'image',
        'title',
        'author',
        'pustakawan'

    ];

    public function pustakawans(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pustakawan', 'id');
    }

    public function borrows(): HasMany
    {
        return $this->hasMany(Borrow::class, 'book_id', 'id');
    }
}
