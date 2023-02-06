<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //si le client est non bloquée, réaliser votre traitement 
        if(Auth::user()->is_active){
            return $next($request);
        }else{
            //si le client est bloquée, on va lui afficher une page contient un message de bloquage
            return redirect('/client/bloquer');
        }
        
    }
}
