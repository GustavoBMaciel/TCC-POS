<?php

namespace App\Http\Controllers\Cadastros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cadastros\Profissao;
use App\Http\Requests\Cadastros\ProfissaoFormRequest;
use App\Http\Controllers\Auth;
use DB;

class ProfissaoController extends Controller
{
    private $profissao;
    private $totalPage = 5;

    public function __construct(Profissao $profissao)
    {
        $this->middleware('auth');

        $this->profissao = $profissao;
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
        $title = 'Cadastrar Nova Profissão';

        $profissoes = $this->profissao->paginate($this->totalPage);

        return view('cadastros.profissao.create-edit', compact('title', 'profissoes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfissaoFormRequest $request)
    {
        $dataForm = $request->all();

        $idProfissao = Profissao::select('codigo')->max('codigo');

        if ($idProfissao == null) {
            $idProfissao = 0;
        }

        $insert = $this->profissao->create([
            'codigo' =>  $idProfissao + 1,
            'nome'   =>  $dataForm['nome']
        ]);
        if ($insert) {
            return redirect()->route('profissao.create');
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
        $profissaoEdit = DB::table('profissao')->where('codigo', $id)->get();

        $profissoes = $this->profissao->paginate($this->totalPage);

        $title = "Editar Profissão: {$profissaoEdit[0]->nome}";

        return view('cadastros.profissao.create-edit', compact('title', 'profissaoEdit', 'profissoes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfissaoFormRequest $request, $id)
    {
        $dataForm = $request->except(['_token', '_method']);

        $profissaoEditado = DB::table('profissao')->where('codigo', $id)->update($dataForm);

        if ($profissaoEditado)
            return redirect()->route('profissao.create');
        else
            return redirect()->route('profissao.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profissaoDestroy = DB::table('profissao')->where('codigo', $id)->delete();

        if ($profissaoDestroy)
            return redirect()->route('profissao.create');
        else
            return redirect()->route('profissao.create');
    }

    public function pesquisa(Request $request)
    {
        $dataForm = $request->all();

        //dd($dataForm);

        $title = 'Cadastrar Nova Profissão';

        $pesquisa = 1;

        $profissoes = $this->profissao->where('nome', $dataForm['texto'])->paginate($this->totalPage);

        return view('cadastros.profissao.create-edit', compact('title', 'profissoes', 'pesquisa'));
    }
}
