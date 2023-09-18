<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class Exames
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
        $loggedUser = \Auth::user();

        $permissaoCli = DB::table('permissaofuncio')->select('codigopermissao')->where('codfun', $loggedUser->id)->pluck('codigopermissao');

        $arrayLength = count($permissaoCli, COUNT_RECURSIVE);

        $users = DB::table('users')->select('users.*')->get();

        dd($users);

        for ($i = 0; $i < $arrayLength; $i++) {

            if ($permissaoCli[$i] ==  3) {
                return $next($request);
            }
        }

        $request->session()->flash('warning', 'Record not added!');

        return redirect()->route('home')->with(['message' => 'Voce não tem permissão para esta Função!']);
    }
}
