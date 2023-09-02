<?php

namespace App\Http\Middleware;

use App\Exceptions\NotFoundException;
use App\Exceptions\NotSetException;
use App\Exceptions\OutOfDateException;
use App\Models\Token;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
class CheckToken 
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response{
        if ($request->hasHeader('token')) {
            $token = Token::where('token', $request->header('token'))->first();

            if ($token) {
                if ($token['expire_token'] > Carbon::now()) {
                    $user = User::findDataById($token["user_id"]);
                    Auth::login($user);
                    return $next($request);
                }else {
                    throw new OutOfDateException();
                }
            }else {
                throw new NotFoundException();
            }
        }
        throw new NotSetException();
    }
}
