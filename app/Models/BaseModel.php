<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public static function filterRequest($query,$request){
        $row_number = 10;
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
        return [
            'query' => $query,
            'row_number' => $row_number
        ];
    }
}