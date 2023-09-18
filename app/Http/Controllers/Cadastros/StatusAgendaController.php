<?php

namespace App\Http\Controllers\Cadastros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cadastros\TbstatusAgenda;
use App\Http\Requests\Cadastros\StatusAgendaFormRequest;
use App\Http\Controllers\Auth;
use DB;

class StatusAgendaController extends Controller
{
    private $tbstatusagenda;
    private $totalPage = 5;

    public function __construct(Tbstatusagenda $tbstatusagenda)
    {
        $this->middleware('auth');
  
      $this->tbstatusagenda = $tbstatusagenda;
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
        $title = 'Cadastrar Novo Status de Agenda';

        $tbstatusagendas = $this->tbstatusagenda->paginate($this->totalPage);

        return view('cadastros.statusagenda.create-edit',compact('title', 'tbstatusagendas') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StatusAgendaFormRequest $request)
    {
        $dataForm = $request->all();

        $insert = $this->tbstatusagenda->create($dataForm);
        if ($insert)
        {
          return redirect()->route('tbstatusagenda.create');
        }
        else {
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
        $tbstatusagendaEdit = DB::table('tbstatusagenda')->where('codigo', $id)->get();

        //dd($id);

        $tbstatusagendas = $this->tbstatusagenda->paginate($this->totalPage);

        $title = "Editar Profissão: {$tbstatusagendaEdit[0]->nome}";
    
        return view('cadastros.statusagenda.create-edit', compact('title', 'tbstatusagendaEdit', 'tbstatusagendas'));
  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StatusAgendaFormRequest $request, $id)
    {
        $dataForm = $request->except(['_token', '_method']);

        $tbstatusagendaEditado = DB::table('tbstatusagenda')->where('codigo', $id)->update($dataForm);
    
        if ( $tbstatusagendaEditado )
        return redirect()->route('tbstatusagenda.create');
        else
        return redirect()->route('tbstatusagenda.create');
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tbstatusagendaDestroy = DB::table('tbstatusagenda')->where('codigo', $id)->delete();
    
        if ( $tbstatusagendaDestroy )
        return redirect()->route('tbstatusagenda.create');
        else
        return redirect()->route('tbstatusagenda.create');  
    }

    
    public function pesquisa(Request $request)
    {
        $dataForm = $request->all();

        //dd($dataForm);

        $title = 'Cadastrar Novo Status de Agenda';

        $pesquisa = 1;

        $tbstatusagendas = $this->tbstatusagenda->where('nome', 'like', '%'.$dataForm['texto'].'%')->paginate($this->totalPage);

        return view('cadastros.statusagenda.create-edit',compact('title', 'tbstatusagendas', 'pesquisa') );
    }
}
