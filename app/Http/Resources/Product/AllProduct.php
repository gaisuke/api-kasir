<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class AllProduct extends JsonResource
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
            'price_format' => 'Rp. '.number_format($this->price, 0, '.', '.'),
            'status' => $this->status ? 'Active' : 'Non Active',
            'created_at' => $this->created_at->format('d M Y')
        ];
    }
}
