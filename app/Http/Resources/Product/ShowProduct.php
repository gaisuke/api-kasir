<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowProduct extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'price' => $this->price,
            'price_format' => 'Rp. ' . number_format($this->price, 0, '.', '.'),
            'stock' => $this->stock,
            'status' => $this->status ? 'Active' : 'Non Active',
            'created_at' => $this->created_at->format('d M Y')
        ];
    }
}
