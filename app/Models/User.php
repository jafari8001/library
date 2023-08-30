<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends BaseModel{
    use HasFactory;

    protected $fillable =[
        "first_name",
        "last_name",
        "phone_number",
        "password",
        "age",
        "gender",
    ];

    public static function getUserByPhoneNumber($request){
        $user = User::where('phone_number', $request['phone_number'])->first();
        return  $user ? $user : false;
    }
    
    public static function loans(): HasMany{
        return User::hasMany(Loan::class)->withTimestamps();   
    }
    public static function tokens(): HasMany{
        return User::hasMany(Token::class)->withTimestamps();
    }
    public  function roles(): BelongsToMany{
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}
