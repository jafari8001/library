<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Action extends BaseModel
{
    use HasFactory;

    public static function roles(): BelongsToMany{
        return Action::belongsToMany(Role::class);
    }
}
