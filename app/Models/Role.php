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
        $model = User::find($request['user_id']);
        $model->roles()->sync($request->role_id);
    }

    public static function users(): BelongsToMany{
        return Role::belongsToMany(User::class)->withTimestamps();
    }    
    public function actions(): BelongsToMany{
        return $this->belongsToMany(Action::class)->withTimestamps();
    }
}
