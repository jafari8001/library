<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends BaseModel
{
    use HasFactory;

    protected $fillable=[
        "title",
        "author",
        "publish_date",
        "barcode",
        "available",
        "category_id",
    ];

    public static function getAllData($request){
        $query = self::query();
        $filtered_result = self::filterRequest($query,$request);
        return $filtered_result['query']
        ->with(['category'=> function($query){
            $query->select("id", "name");
        }])->paginate($filtered_result['row_number']);
    }
    public static function checkAvailable($id){
        $book = Book::findDataById($id);
        if ($book["available"] <= 1) {
            return false;
        }
        return true;
    }
    public function category(): BelongsTo{
        return $this->belongsTo(Category::class);
    }
    public function loans():HasMany{
        return $this->hasMany(Loan::class);
    }
}
