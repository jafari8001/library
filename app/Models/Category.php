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
    public static $columns = [
        'id' =>  'categories.id',
        'name' =>  'categories.name'
    ];
    public static function getAllData($request){
        $query = self::query();
        $filtered_result = self::filterRequest($query, $request, self::$columns);
        return $filtered_result['query']
            ->with('books', fn($query) => $query->select('id', 'title', 'category_id'))
            ->paginate($filtered_result['row_number']);
    }
    public function books(): HasMany{
        return $this->hasMany(Book::class);
    }
}
