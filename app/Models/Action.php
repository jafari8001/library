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
        $model = Role::find($request['role_id']);
        $model->actions()->sync($request->action_id);
    }

    public function roles(): BelongsToMany{
        return $this->belongsToMany(Role::class);
    }
}
