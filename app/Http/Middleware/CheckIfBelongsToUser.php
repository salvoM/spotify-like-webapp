<?php

namespace App\Http\Middleware;
// use App\Http\Controllers\Auth;
use App\Collection;
use Closure;
use Auth;

class CheckIfBelongsToUser
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
        $collection = $request->route('collection');
        // Collection::where('id', $collection->id)->where('id_utente', Auth::user()->id)->get()->isEmpty()
        if($collection->id_utente != Auth::user()->id){
            return redirect('/collection')->withErrors("Non disponi dei permessi necessari per visualizzare questa playlist!"); 
        }
        else return $next($request);
    }
}
