<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // a product belongsTo a category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // a product belongstomany tags
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id');
    }

    public function scopeFilter($query, $filters)
    {
        $query->when($filters['search'] ?? false, function ($query) {
            $query->where('name', 'LIKE', '%' .request('search').'%');
        })
            ->when($filters['tag'] ?? false, function ($query) {
            $query->whereHas('tags', function ($query) {
            $query->where('id', request('tag'));
            });
        });
    }
}
