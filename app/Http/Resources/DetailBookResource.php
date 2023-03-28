<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailBookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'cover' => $this->image,
            'title' => $this->title,
            'pustakawan' => $this->whenLoaded('pustakawans'),
            'Total Borrower'=> $this->whenLoaded('borrows', function() {
                return count($this->borrows);
            }),
            'peminjam buku ini' => $this->whenLoaded('borrows', function() {
                return collect($this->borrows)->each(function($borrow) {
                    $borrow->borrower;
                    return $borrow;
                });
            })


        ];
    }
}
