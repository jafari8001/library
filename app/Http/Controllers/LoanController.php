<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LoanController extends Controller
{
    protected $rules = [
        'user_id' => 'required|integer',
        'book_id' => 'required|integer',
    ];
    public function addLoan(Request $request){
        $this->validateRequest($request, $this->rules);
        // data for send to save in loan
        $data = [
            "user_id" =>  $request["user_id"],
            "book_id" => $request["book_id"],
            "loan_date" => Carbon::now(),
            "return_date" => Carbon::now()->addDays(20),
        ];
        // find and get book data
        $book_data = Book::findDataById($request["book_id"]);
        if ($book_data == false) {
            return showResponse(
                404,
                "Data not found"
            );
        }
        // check for available
        if (!Book::checkAvailable($book_data["id"])) {
            return showResponse(
                400,
                "Book available not enugh"
            );
        }
        // decrement book available
        Book::editData( ["available"=> $book_data["available"] - 1] ,$book_data);
        
        return showResponse(
            200,
            "Add data successfull",
            $this->model_name::insertData($data)
        );
    }
    protected $model_name = Loan::class;
}
