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

    public function loans(): HasMany{
        return $this->hasMany(Loan::class);
    }
}
