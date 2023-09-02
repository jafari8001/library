<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable;
class User extends BaseModel implements Authenticatable{
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
    
    public function loans(): HasMany{
        return $this->hasMany(Loan::class)->withTimestamps();   
    }
    public function tokens(): HasMany{
        return $this->hasMany(Token::class)->withTimestamps();
    }
    public function roles(): BelongsToMany{
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function isAdmin(){
        return $this->roles->first()->name === "admin";
    }






    public function getAuthIdentifierName()
    {
        return 'phone_number';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
