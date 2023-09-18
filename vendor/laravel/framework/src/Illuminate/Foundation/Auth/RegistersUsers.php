<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Models\Cadastros\Acesso;
use App\Http\Requests\Cadastros\AcessoFormRequest;
use DB;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(AcessoFormRequest $request)
    {
        //dd($request);
        //registrando usuarios

        $request['ativo'] = (!isset($request['ativo'])) ? 0 : 1;

        $idAcesso = Acesso::select('codigo')->max('codigo');

        if ($idAcesso == null) {
            $idAcesso = 0;
        }

        $insert = DB::table('acesso')->insert([
            'codigo'        =>  $idAcesso + 1,
            'Usuario'       =>  $request['name'],
            'Senha'         =>  $request['password'],
            'dataCadastro'  =>  $request['dataCadastro'],
            'ativo'         =>  $request['ativo'],
            'fone'          =>  $request['fone']
        ]);

        if ($insert) {
        $this->validator($request->all())->validate();

        //dd($request->all());

        event(new Registered($user = $this->create([
            'id'         =>  $idAcesso + 1,
            'name'       =>  $request['name'],
            'password'   =>  $request['password']
        ])));

//dd($user);

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
        }
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
