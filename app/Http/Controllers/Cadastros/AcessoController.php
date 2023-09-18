<?php

namespace App\Http\Controllers\Cadastros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cadastros\Acesso;
use App\Http\Controllers\Auth;
use DB;

class AcessoController extends Controller
{
    private $acesso;
    private $totalPage = 5;

    public function __construct(Acesso $acesso)
    {
        //$this->middleware('auth');

        $this->acesso = $acesso;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastrar Novo Usuário';

        $acessos = Acesso::select('acesso.*',DB::raw('DATE_FORMAT(dataCadastro,"%d-%m-%Y") as dataCadastro'))->paginate($this->totalPage);

        return view('cadastros.acesso.create-edit', compact('title', 'acessos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataForm = $request->all();

        $dataForm['ativo'] = (!isset($dataForm['ativo'])) ? 0 : 1;

        $idAcesso = Acesso::select('codigo')->max('codigo');

        if ($idAcesso == null) {
            $idAcesso = 0;
        }

        $insert = $this->acesso->create([
            'codigo'         =>  $idAcesso + 1,
            'Usuario'        =>  $dataForm['name'],
            'Senha'          =>  $dataForm['password'],
            'fone'           =>  $dataForm['fone'],
            'ativo'          =>  $dataForm['ativo'],
            'dataCadastro'   =>  $dataForm['dataCadastro']
        ]);
        if ($insert) {
            return redirect()->route('acesso.create');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $acessoEdit = Acesso::select('acesso.*',DB::raw('DATE_FORMAT(dataCadastro,"%Y-%m-%d") as dataCadastro'), 'acesso.Usuario as name', 'acesso.Senha as password')->where('codigo', $id)->get();

        $acessos = Acesso::select('acesso.*',DB::raw('DATE_FORMAT(dataCadastro,"%d-%m-%Y") as dataCadastro'))->paginate($this->totalPage);

        $title = "Editar Usuário: {$acessoEdit[0]->Usuario}";
    
        return view('cadastros.acesso.create-edit', compact('title', 'acessoEdit', 'acessos'));
   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataForm = $request->except(['_token', '_method']);
  
        $acessoEditado = DB::table('acesso')->where('codigo', $id)->update([
            'Usuario'        =>  $dataForm['name'],
            'Senha'          =>  $dataForm['password'],
            'fone'           =>  $dataForm['fone'],
            'ativo'          =>  $dataForm['ativo'],
            'dataCadastro'   =>  $dataForm['dataCadastro']]);

        $userEditado  = DB::table('users')->where('id', $id)->update([
            'name'        =>  $dataForm['name'],
            'password'    =>  $dataForm['password']]);
      
        if ( $acessoEditado && $userEditado)
        return redirect()->route('acesso.create');
        else
        return redirect()->route('acesso.create');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $acessoDestroy = DB::table('acesso')->where('codigo', $id)->delete();

        $usersDestroy = DB::table('users')->where('id', $id)->delete();
    
        if ( $acessoDestroy )
        return redirect()->route('acesso.create');
        else
        return redirect()->route('acesso.create');
    }

    public function pesquisa(Request $request)
    {
        $dataForm = $request->all();

        //dd($dataForm);

        $title = 'Cadastrar Novo Usuário';

        $pesquisa = 1;

        $acessos = Acesso::select('acesso.*',DB::raw('DATE_FORMAT(dataCadastro,"%d-%m-%Y") as dataCadastro'))
        ->where('Usuario', 'like', '%'.$dataForm['texto'].'%')
        ->paginate($this->totalPage);

        return view('cadastros.acesso.create-edit', compact('title', 'acessos', 'pesquisa'));
    }
}
