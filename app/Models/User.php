<?php

namespace App\Models;

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
                'status'=> 201,
                'message'=> 'Create user successfull',
                'data'=> $create
            ];
    }

    public static function getAllUsers($request){
        $query = User::query();
        
            if (isset($request['filters'])) {
                foreach ($request['filters'] as $key => $value) {
                    if(isset($value['op'])){
                        $query->where($key, $value['op'], $value['value']);
                    }else{
                        $query->where($key, 'like', '%' . $value . '%');
                    }
                }
            } 
            if (isset($request['order_by'])) {
                foreach ($request['order_by'] as $key => $value) {
                    $query->orderBy($key, $value);
                }
            }            
            return [
                'status'=> 200,
                'message'=> 'users in dataase',
                'data'=> [
                    'Users'=> $query->get(),
                    'count'=> $query->count()
                ]
            ];
        
    }
    public static function editUser($data, $user){
        if ($user == false) {
            return [
                'status'=> 404,
                'message'=> 'user not found',
                'data'=> ''
            ];
        }
        $user['data']->update($data);
        return [
            'status'=> 201,
            'message'=>'updating user successfull',
            'data'=>$user
        ];
    }
    public static function deleteUser($user){
        if ($user == false) {
            return [
                'status'=> 404,
                'message'=> 'user not found',
                'data'=> ''
            ];
        }
        $user['data']->delete();
        return [
            'status'=> 200,
            'message'=> 'Removing user seccessful',
            'data'=> $user
        ];
    }
    public static function findUserById($id){
        $user = User::find($id);
        if ($user == null) {
            return false;
        }
        return [
            'status'=> 200,
            'message'=> 'find user successfull',
            'data'=> $user->first()
        ];
    }


    public function loans(): HasMany{
        return $this->hasMany(Loan::class);
    }
}
