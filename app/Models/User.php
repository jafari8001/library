<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    use HasFactory;

    protected $fillable =[
        "first_name",
        "last_name",
        "age",
        "gender",
    ];

    public static function insertUser($data){
        
        $create = User::create($data);
        return[
                "status"=>'200',
                "message"=>'User created',
                "data"=> $create,
        ];
    }
    public static function getAllUsers(){
        return User::all();
    }
    public static function editUser($data, $user){
        try {
            $user->update($data);
            return [
                'status'=> 201,
                'message'=>'updating user successfull',
                'data'=>$data
            ];
        } catch (Exception $err) {
                return Response()->json([
                'status'=> $err->getCode(),
                'message'=>$err->getMessage(),
                'data'=>''
            ]);
        }
    }
    public static function deleteUser($user){
        $del = $user->delete();

        if($del){
            return [
                'status'=> 201,
                'message'=> 'User removing seccessful',
                'data'=> "",
            ];
        }else {
            return[
                'status'=> 400,
                'message'=> 'User removing faild',
                'data'=> "",
            ];
        }
    }
    public static function findUserById($id){
        return User::find($id)->first();
    }
    public function loans(): HasMany{
        return $this->hasMany(Loan::class);
    }
}
