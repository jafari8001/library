<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends BaseModel
{
    use HasFactory;

    protected $fillable =[
        "first_name",
        "last_name",
        "age",
        "gender",
    ];

    public static function getAllData($request){
        $query = User::query();
        $filtered_result = self::filterRequest($query,$request);
        return $filtered_result['query']->paginate($filtered_result['row_number']);
    }
    public static function insertData($data){
            $create = User::create($data);
            return $create;
    }
    public static function editData($data, $user){
        $user->update($data);
        return $user;
    }
    public static function deleteData($user){
        $user->delete();
        return $user;
    }
    public static function findDataById($id){
        $user = User::find($id);
        if ($user == null) {
            return false;
        }
        return $user;
    }


    public function loans(): HasMany{
        return $this->hasMany(Loan::class);   
    }
}
