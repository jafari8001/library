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
    protected $model_name = Loan::class;
    public function addLoan(Request $request){
        $this->validateRequest($request, $this->rules);
        // data for send to save in loan
        $data = [
            "user_id" =>  $request["user_id"],
            "book_id" => $request["book_id"],
            "loan_date" => Carbon::now(),
            "return_date" => Carbon::now()->addDays($request["return_date"]),
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
    public function showLoan(){
        return showResponse(
            200,
            "All loans",
            $this->model_name::showLoan());
    }
    public function loanDelayed(){
        return showResponse(
            200,
            "delayed loans",
            $this->model_name::loanDelayed());
    }
    public function loanInDate(Request $request){
        $this->validateRequest($request, [
            "loan_date"=> "required|string"
        ]);
        return showResponse(
            200,
            "delayed loans",
            $this->model_name::loanInDate($request));
    }
}
