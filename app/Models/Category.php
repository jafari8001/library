<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        "name"
    ];

    public static function showCategoryWithBooks(){
        return Category::with(['books' => function ($query) {
            $query->select('id', 'title', 'category_id');
        }])->get(['id', 'name']);
    }
    public function books():HasMany{
        return $this->hasMany(Book::class);
    }
}
