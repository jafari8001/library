<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $rules = [
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'publish_date' => 'required|string|max:255',
        'barcode' => 'required|string|max:255',
        'available' => 'required|integer|min:0',
        'category_id' => 'required|integer',
    ];
    protected $data_inputs = [
        "title",
        "author",
        "publish_date",
        "barcode",
        "available",
        "category_id",
    ];
    protected $model_name = Book::class;

}
