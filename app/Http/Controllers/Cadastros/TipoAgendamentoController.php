<?php

namespace App\Http\Controllers\Cadastros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cadastros\TbtipoAgendamento;
use App\Models\Cadastros\Tbprofissional;
use App\Http\Requests\Cadastros\TipoAgendamentoFormRequest;
use App\Http\Controllers\Auth;
use DB;

class TipoAgendamentoController extends Controller
{
    private $tbtipoagendamento;
    private $totalPage = 5;

    public function __construct(Tbtipoagendamento $tbtipoagendamento)
    {
        $this->middleware('auth');

        $this->tbtipoagendamento = $tbtipoagendamento;
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
        $title = 'Cadastrar Novo Tipo de Agendamento';

        $cdProfissionais = Tbprofissional::select('dsNomeMedico', 'cdProfissional')->where('dsAtivo', 'S')->get();

        $tbtipoagendamentos = DB::table('tbtipoagendamento')
        ->join('tbprofissional', 'tbtipoagendamento.cdProfissional', '=', 'tbprofissional.cdProfissional')
        ->select('tbtipoagendamento.*', 'tbprofissional.*', 'tbprofissional.cdProfissional as cdProfissional2')
        ->paginate($this->totalPage);

        return view('cadastros.tipoagendamento.create-edit', compact('title', 'tbtipoagendamentos', 'cdProfissionais'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoAgendamentoFormRequest $request)
    {
        $dataForm = $request->all();

        //dd($dataForm);

        $insert = $this->tbtipoagendamento->create($dataForm);
        if ($insert) {
            return redirect()->route('tbtipoagendamento.create');
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
        $tbtipoagendamentos = DB::table('tbtipoagendamento')
        ->join('tbprofissional', 'tbtipoagendamento.cdProfissional', '=', 'tbprofissional.cdProfissional')
        ->select('tbtipoagendamento.*', 'tbprofissional.*', 'tbprofissional.cdProfissional as cdProfissional2')
        ->paginate($this->totalPage);

        //dd($id);

        $cdProfissionais = Tbprofissional::select('dsNomeMedico', 'cdProfissional')->where('dsAtivo', 'S')->get();

        $tbtipoagendamentoEdit = DB::table('tbtipoagendamento')
        ->join('tbprofissional', 'tbtipoagendamento.cdProfissional', '=', 'tbprofissional.cdProfissional')
        ->select('tbtipoagendamento.*', 'tbprofissional.*', 'tbprofissional.cdProfissional as cdProfissional2')
        ->where('cdTipoAgendamento', $id)
        ->get();

        //dd($tbtipoagendamentoEdit);

        $title = "Editar Tipo de Agendamento: {$tbtipoagendamentoEdit[0]->nome}";

        return view('cadastros.tipoagendamento.create-edit', compact('title', 'tbtipoagendamentoEdit', 'tbtipoagendamentos', 'cdProfissionais'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipoAgendamentoFormRequest $request, $id)
    {
        $dataForm = $request->except(['_token', '_method']);

        $tbtipoagendamentoEditado = DB::table('tbtipoagendamento')->where('cdTipoAgendamento', $id)->update($dataForm);

        if ($tbtipoagendamentoEditado)
            return redirect()->route('tbtipoagendamento.create');
        else
            return redirect()->route('tbtipoagendamento.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tbtipoagendamentoDestroy = DB::table('tbtipoagendamento')->where('cdTipoAgendamento', $id)->delete();

        if ($tbtipoagendamentoDestroy)
            return redirect()->route('tbtipoagendamento.create');
        else
            return redirect()->route('tbtipoagendamento.create');
    }

    public function pesquisa(Request $request)
    {
        $dataForm = $request->all();

        //dd($dataForm);

        $title = 'Cadastrar Novo Tipo de Agendamento';

        $pesquisa = 1;

        $cdProfissionais = Tbprofissional::select('dsNomeMedico', 'cdProfissional')->where('dsAtivo', 'S')->get();

        $tbtipoagendamentos = DB::table('tbtipoagendamento')
        ->join('tbprofissional', 'tbtipoagendamento.cdProfissional', '=', 'tbprofissional.cdProfissional')
        ->select('tbtipoagendamento.*', 'tbprofissional.*', 'tbprofissional.cdProfissional as cdProfissional2')
        ->where('nome', 'like', '%'.$dataForm['texto'].'%')
        ->paginate($this->totalPage);

        return view('cadastros.tipoagendamento.create-edit', compact('title', 'tbtipoagendamentos', 'cdProfissionais', 'pesquisa'));
    }
}
