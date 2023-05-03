<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Borrow extends Model
{
    use HasFactory;

   protected $fillable = [
    'book_id',
    'borrower',
   ];

   public function borrower(): BelongsTo
   {
       return $this->belongsTo(User::class, 'borrower', 'id');
   }
}
