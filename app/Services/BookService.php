<?php 

namespace App\Services;
use App\Models\Book;


class UserService {
    public static function getLoanCount($id){
        return Book::find($id)->loans()->count();
    }
}