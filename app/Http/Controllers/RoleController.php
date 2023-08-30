<?php

namespace App\Http\Controllers;

use App\Models\Role;

class RoleController extends Controller{
    protected $rules = [
        'name' => 'required|string|max:255'
    ];
    protected $data_inputs = [
        "name"
    ];
    protected $model_name = Role::class;
}
