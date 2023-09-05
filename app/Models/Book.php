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

    public static $columns = [
        'id' =>  'books.id',
        'title' =>  'books.title',
        'author' =>  'books.author',
        'publish_date' =>  'books.publish_date',
        'barcode' =>  'books.barcode',
        'available' =>  'books.available',
        'category_id' =>  'books.category_id',
        'category_name' =>  'categories.name'
    ];

    public static function getAllData($request){
        $query = self::query();
        $filtered_result = self::filterRequest($query,$request,self::$columns);

        $result = $filtered_result['query']
            ->join('categories','categories.id' , '=' , 'books.category_id')
            ->select(
                'books.*',
                'categories.id as category_id',
                'categories.name as category_name',
            );  
        return $result->paginate($filtered_result['row_number']);
    }
    public static function checkAvailable($id){
        $book = Book::findDataById($id);
        if ($book["available"] <= env('MINIMUM_BOOK_NUMBER')) {
            return false;
        }
        return true;
    }
    public function category(): BelongsTo{
        return $this->belongsTo(Category::class);
    }
    public function loans(): HasMany{
        return $this->hasMany(Loan::class);
    }
}
