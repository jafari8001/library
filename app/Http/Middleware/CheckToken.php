<?php

namespace App\Http\Middleware;

use App\Exceptions\NotFoundException;
use App\Exceptions\NotSetException;
use App\Exceptions\OutOfDateException;
use App\Models\Token;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
            $user = Token::where('token', $request->header('token'))->first();
            if ($user) {
                if ($user['expire_token'] > Carbon::now()) {
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
