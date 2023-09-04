<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $rules = [
        'name' => 'required|string|max:255',
    ];
    protected $data_inputs = [
        "name"
    ];
    protected $model_name = Category::class;

}
