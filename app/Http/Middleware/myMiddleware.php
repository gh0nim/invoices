<?php

namespace App\Http\Middleware;

use App\User;

use Closure;

class myMiddleware
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
        $email = User::where('email', $request->email)->get();
        $password = User::where('password', $request->password)->get();

            $status = User::where('email', $request->email)->where('password', $request->password)->get('Status');
            if ($status == 'مفعل') {
                
                return $next($request);
            }
         else {
            # code...
            return redirect()->route('login');
        }

        // return $next($request);
    }
}
