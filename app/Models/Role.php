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

    public static function addRoleToUser($request){
        $user = User::findDataById($request["user_id"]);
        $role = Role::find($request["role_id"]);

        return $user->roles()->save($role);
    }

    public static function users(): BelongsToMany{
        return Role::belongsToMany(User::class)->withTimestamps();
    }    
    public static function actions(): BelongsToMany{
        return Role::belongsToMany(Action::class)->withTimestamps();
    }
}
