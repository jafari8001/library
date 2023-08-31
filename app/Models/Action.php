<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Action extends BaseModel
{
    use HasFactory;

    protected $fillable=[
        "route_name",
        "fa_name"
    ];

    public static function addActionToRole($request){
        $user = Action::findDataById($request["action_id"]);
        $role = Role::find($request["role_id"]);

        return $user->roles()->save($role);
    }

    public function roles(): BelongsToMany{
        return $this->belongsToMany(Role::class);
    }
}
