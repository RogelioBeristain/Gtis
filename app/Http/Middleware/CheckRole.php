<?php

namespace App\Http\Middleware;
use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;

use Closure;

class CheckRole
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
         // dd($request);
          
         if ($request->user()->getRoleNames()->isEmpty()) {
        return redirect('client/home');
        
    }else{
       return $next($request);
    }
        return $next($request);
    }
}
