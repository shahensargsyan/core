<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\ApiUser;

class CheckApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->token) {
            return response()->json([
                                        'error' => true,
                                        'message' => 'Invalid token',
                                    ]);
        }
        
        $api_user = ApiUser::where('token', $request->token)->first();
        if(!$api_user || !$api_user->user || !$api_user->user->active || $api_user->user->role != 'customer'){
            return response()->json([
                                        'error' => true,
                                        'message' => 'Not authorized',
                                    ]);
        }
        
        $api_user->update([
                            'last_login_at' => date('Y-m-d H:i:s')
                        ]);
        
        return $next($request);
    }
}
