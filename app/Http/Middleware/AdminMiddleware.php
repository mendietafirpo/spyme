<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $idRole = DB::table('role_user')
        ->where('user_id','=',Auth::user()->id)
        ->get()->first()->role_id;
        session()->put('idRole', $idRole);

        if ($idRole==1){
            return $next($request);
        }
        else {
            return redirect('/');
        }
    }
}
