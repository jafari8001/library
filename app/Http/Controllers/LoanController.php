<?php

namespace App\Http\Controllers;

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
        $data = [
            "user_id" =>  $request["user_id"],
            "book_id" => $request["book_id"],
            "loan_date" => Carbon::now(),
            "return_date" => Carbon::now()->addDays(20),
        ];
        return showResponse(
            200,
            "Add data successfull",
            $this->model_name::insertData($data)
        );
    }
    protected $model_name = Loan::class;
}
