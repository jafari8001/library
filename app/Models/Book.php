<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
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

    public static function insertBook($data){
        
        $create = Book::create($data);
        return[
                "status"=>'200',
                "message"=>'Book created',
                "data"=> $create,
        ];
    }
    public static function getAllBooks(){
        return Book::all();
    }
    public static function editBook($data, $book){
        try {
            $book->update($data);
            return [
                'status'=> 201,
                'message'=>'updating Book successfull',
                'data'=>$data
            ];
        } catch (Exception $err) {
                return Response()->json([
                'status'=> $err->getCode(),
                'message'=>$err->getMessage(),
                'data'=>''
            ]);
        }
    }
    public static function deleteBook($book){
        $del = $book->delete();

        if($del){
            return [
                'status'=> 201,
                'message'=> 'Book removing seccessful',
                'data'=> "",
            ];
        }else {
            return[
                'status'=> 400,
                'message'=> 'Book removing faild',
                'data'=> "",
            ];
        }
    }
    public static function findBookById($id){
        return Book::find($id)->first();
    }
    public function category(): BelongsTo{
        return $this->belongsTo(Category::class);
    }
    public function loans():HasMany{
        return $this->hasMany(Loan::class);
    }
}
