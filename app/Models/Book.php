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
