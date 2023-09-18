<?php

namespace App\Http\Controllers\Cadastros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cadastros\Tipo;
use App\Http\Requests\Cadastros\TipoFormRequest;
use App\Http\Controllers\Auth;
use DB;

class TipoController extends Controller
{
    private $tipo;
    private $totalPage = 5;

    public function __construct(Tipo $tipo)
    {
        $this->middleware('auth');
  
      $this->tipo = $tipo;
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
        $title = 'Cadastrar Novo Tipo';

        $tipos = $this->tipo->paginate($this->totalPage);

        return view('cadastros.tipo.create-edit',compact('title', 'tipos') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoFormRequest $request)
    {
        $dataForm = $request->all();

        $insert = $this->tipo->create($dataForm);
        if ($insert)
        {
          return redirect()->route('tipo.create');
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
        $tipoEdit = DB::table('tipo')->where('nome', $id)->get();

        $tipos = $this->tipo->paginate($this->totalPage);

        $title = "Editar Tipo: {$tipoEdit[0]->nome}";
    
        return view('cadastros.tipo.create-edit', compact('title', 'tipoEdit', 'tipos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipoFormRequest $request, $id)
    {
        $dataForm = $request->except(['_token', '_method']);

        $tipoEditado = DB::table('tipo')->where('nome', $id)->update($dataForm);
    
        if ( $tipoEditado )
        return redirect()->route('tipo.create');
        else
        return redirect()->route('tipo.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipoDestroy = DB::table('tipo')->where('nome', $id)->delete();
    
        if ( $tipoDestroy )
        return redirect()->route('tipo.create');
        else
        return redirect()->route('tipo.create');
    }

    public function pesquisa(Request $request)
    {
        $dataForm = $request->all();

        //dd($dataForm);

        $title = 'Cadastrar Novo Tipo';

        $pesquisa = 1;

        $tipos = $this->tipo->where('nome', 'like', '%'.$dataForm['texto'].'%')->paginate($this->totalPage);

        return view('cadastros.tipo.create-edit',compact('title', 'tipos', 'pesquisa') );
    }
}
