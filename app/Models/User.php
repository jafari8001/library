<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\helpers\ResponseHelper;

class User extends Model
{
    use HasFactory;

    protected $fillable =[
        "first_name",
        "last_name",
        "age",
        "gender",
    ];

    public static function getAllData($request){
        $row_number = 10;
        $query = User::query();
            if (isset($request['row_number'])) {
                $row_number = $request['row_number'];
            }
            if (isset($request['filters'])) {
                foreach ($request['filters'] as $key => $value) {
                    if(isset($value['operation'])){
                        switch ($value['operation']) {
                            case 'in':
                                $query->whereIn($key, $value['value']);
                                break;
                            case 'between':
                                $query->whereBetween($key, $value['value']);
                                break;   
                            default:
                                $query->where($key, $value['operation'], $value['value']);
                                break;
                        }
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
            return ResponseHelper::showResponse(
                200,
                'users in dataase', 
                [
                    "Users"=> $query->paginate($row_number),
                    'count'=> $row_number
                ]);
        
    }
    public static function insertData($data){
            $create = User::create($data);
            return[
                'status'=> 201,
                'message'=> 'Create user successfull',
                'data'=> $create
            ];
    }
    public static function editData($data, $user){
        if ($user == false) {
            return ResponseHelper::showResponse(
                404,
                "user not found",
            );
        }
        $user['data']->update($data);
        return ResponseHelper::showResponse(
            201,
            "updating user successfull",
            $user
        );
    }
    public static function deleteData($user){
        if ($user == false) {
            return ResponseHelper::showResponse(
                404,
                "user not found",
            );
        }
        $user['data']->delete();
        return ResponseHelper::showResponse(
            200,
            "Removing user seccessful",
            $user
        );
    }
    public static function findDataById($id){
        $user = User::find($id);
        if ($user == null) {
            return false;
        }
        return ResponseHelper::showResponse(
            200,
            "Find user successfull",
            $user->first()
        );
    }


    public function loans(): HasMany{
        return $this->hasMany(Loan::class);   
    }
}
