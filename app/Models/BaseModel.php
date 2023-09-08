<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
class BaseModel extends Model
{
    use SoftDeletes;
    public static function filterRequest($query, $request, $columns){
        $row_number = 10;
        if (isset($request['row_number'])) {
            $row_number = $request['row_number'];
        }
        if (isset($request['filters'])) {
            foreach ($request['filters'] as $key => $value) {
                if (!in_array($key,array_keys($columns))) {
                    continue;
                }else{
                    $key = $columns[$key];
                }
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
        return [
            'query' => $query,
            'row_number' => $row_number
        ];
    }
    public static function insertData($data){
        if (isset($data['password'])) {
            $pass = $data['password'];
            $data['password'] = Hash::make($pass);
        }
        $create = self::create($data);
        return $create;
    }
    public static function editData($send_request, $data){
        $data->update($send_request);
        return $data;
    }
    public static function deleteData($user){
        $user->delete();
        return $user;
    }
    public static function findDataById($id){
        $user = self::find($id);
        if ($user == null) {
            return false;
        }
        return $user;
    }
}