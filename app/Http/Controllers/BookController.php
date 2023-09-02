<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:255',
        'password' => 'required|string|max:255',
        'age' => 'required|integer|min:0',
        'gender' => 'required|in:male,female',
    ];
    protected $data_inputs = [
        "first_name",
        "last_name",
        "password",
        "phone_number",
        "age",
        "gender"
    ];
    protected $model_name = User::class;
}
