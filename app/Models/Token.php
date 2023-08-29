<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Token extends Model
{
    use HasFactory;
    protected $fillable=[
        "user_id",
        "token",
        "expire_token"
    ];

    public static function insertToken($data){
        $token = Token::create($data);
        return $token;
    }
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
