<?php

namespace App\Models;

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
    
    public function loans(): HasMany{
        return $this->hasMany(Loan::class);   
    }
    public function tokens(): HasMany{
        return $this->hasMany(Token::class);
    }
}
