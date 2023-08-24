<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\BookService;
use App\Models\Book;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function addBook(Request $request){
        $data = $request->only([
            "title",
            "author",
            "publish_date",
            "barcode",
            "available",
            "category_id",
        ]);
        return Response()->json(Book::insertBook($data));
    }
    public function getBook(){
        return Response()->json(Book::getAllBook());
    }
    public function editBook(Request $request){
        $book = Book::findBookById($request->id);
        $data = $request->only([
            "title",
            "author",
            "publish_date",
            "barcode",
            "available",
            "category_id",
        ]);
        return Response()->json(Book::editBook($data, $book));
    }
    public function deleteBook(Request $request){
        $book = Book::findBookById($request->id);
        return Response()->json(Book::deleteBook($book));
    }
    public function countLoan(Request $request){
        $load_number = BookService::getLoanCount($request->id);
        return Response()->json($load_number);
    }
    public function getUserById(Request $request){
        return Response()->json(Book::findUserById($request->id));
    }
}
