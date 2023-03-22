<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Borrow extends Model
{
    use HasFactory;

   protected $fillable = [
    'name',
    'book_id',
    'user_id',
   ];

   public function borrower(): BelongsTo
   {
       return $this->belongsTo(User::class, 'user_id', 'id');
   }
}
