<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends BaseModel
{
    use HasFactory;

    protected $fillable= [
        "name"
    ];

    public static function users(): BelongsToMany{
        return Role::belongsToMany(User::class);
    }
}
