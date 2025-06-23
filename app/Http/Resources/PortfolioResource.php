<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image_path' => $this->image_path ? asset('storage/' . $this->image_path) : null,
            'project_url' => $this->project_url,
            'category_id' => $this->category_id,
            'images' => $this->images->map(function ($image) {
                return [
                    'id' => $image->id,
                    'path' => asset('storage/' . $image->path),
                ];
            }),
        ];
    }
}
