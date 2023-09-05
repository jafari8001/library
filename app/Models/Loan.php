<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Loan extends BaseModel
{
    use HasFactory;

    protected $fillable =[
        "user_id",
        "book_id",
        "loan_date",
        "return_date",
    ];

    public static function getAllData($request){
        $query = self::query();
        $filtered_result = self::filterRequest($query,$request);
        return $filtered_result['query']
            ->with([
                'user',
                'book' => function ($query) {
                    $query->select('id', 'title', "category_id");
                }])
            ->paginate($filtered_result['row_number']);
    }
    public static function loanDelayed(){
        return Loan::where('return_date', "<=", Carbon::now())
            ->with(['user'])
            ->with(['book' => function ($query) {
                $query->select('id', 'title', "category_id");
            }])
            ->get(['id', 'user_id', 'book_id', 'loan_date', 'return_date']);
    }
    public static function loanInDate($request){
        return Loan::where("loan_date", "=", $request->loan_date)->paginate();
    }
    
    public function user(): BelongsTo{
        return $this->belongsTo(User::class)
            ->select('id', 'first_name', 'last_name', 'phone_number');
    }
    public function book(): BelongsTo{
        return $this->belongsTo(Book::class);
    }
}
