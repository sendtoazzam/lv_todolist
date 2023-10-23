<?php

namespace App\Http\Middleware;
use Illuminate\Http\Response;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }


    // protected function unauthenticated($request, array $guards): Response
    // {
    //     if(request()->hasHeader('Authorization') || $request->is('api/*')){
    //         return Response(
    //             [
    //                 'status' => 'Error',
    //                 'message' => 'Unauthenticated',
    //                 'data' => []
    //             ], 401);
    //     }
    
    //     Parent::unauthenticated($request, $guards);
    // }
}
