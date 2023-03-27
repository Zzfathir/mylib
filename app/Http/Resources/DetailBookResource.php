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
            'cover' => $this->cover,
            'title' => $this->title,
            'pustakawan' => $this->whenLoaded('pustakawans'),
            'peminjam buku ini' => $this->whenLoaded('borrows', function() {
                return collect($this->borrows)->each(function($borrow) {
                    $borrow->borrows;
                    return $borrow;
                });
            })


        ];
    }
}
