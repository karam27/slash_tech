<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{

    protected $fillable = ['title', 'description', 'image_path', 'project_url', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function images()
    {
        return $this->hasMany(PortfolioImage::class);
    }
}
