<?php

namespace App\Http\Controllers\Cadastros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cadastros\Convenio;
use App\Http\Requests\Cadastros\ConvenioFormRequest;
use App\Http\Controllers\Auth;
use DB;

class ConvenioController extends Controller
{
    private $convenio;
    private $totalPage = 5;
  
    public function __construct(Convenio $convenio)
    {
      //$this->middleware('auth');
  
      $this->convenio = $convenio;
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
        $title = 'Cadastrar Novo Convenio';

        $convenios  = Convenio::select('convenio.*',DB::raw('DATE_FORMAT(dtcad,"%d-%m-%Y") as dtcad'))->paginate($this->totalPage);

        return view('cadastros.convenio.create-edit',compact('title', 'convenios') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConvenioFormRequest $request)
    {
        $dataForm = $request->all();

        //dd($dataForm);

        $dataForm['ativo'] = ( !isset ($dataForm['ativo']) ) ? 0 : 1;
    
        $insert = $this->convenio->create($dataForm);
        if ($insert)
        {
          return redirect()->route('convenio.create');
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
        $convenioEdit = Convenio::select('convenio.*',DB::raw('DATE_FORMAT(dtcad,"%Y-%m-%d") as dtcad'))->where('Cod', $id)->get();

        $convenios  = Convenio::select('convenio.*',DB::raw('DATE_FORMAT(dtcad,"%d-%m-%Y") as dtcad'))->paginate($this->totalPage);

        $title = "Editar Convenio: {$convenioEdit[0]->nome}";
    
        return view('cadastros.convenio.create-edit', compact('title', 'convenioEdit', 'convenios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConvenioFormRequest $request, $id)
    {
        $dataForm = $request->except(['_token', '_method']);

        $dataForm['ativo'] = ( !isset ($dataForm['ativo']) ) ? 0 : 1;

        //dd($dataForm);

        $convenioEditado = DB::table('convenio')->where('Cod', $id)->update($dataForm);
    
        if ( $convenioEditado )
        return redirect()->route('convenio.create');
        else
        return redirect()->route('convenio.create', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $convenioDestroy = DB::table('convenio')->where('Cod', $id)->delete();

        if ( $convenioDestroy )
        return redirect()->route('convenio.create');
        else
        return redirect()->route('convenio.create');
    }

    public function pesquisa(Request $request)
    {
        $dataForm = $request->all();

        //dd($dataForm);

        $title = 'Cadastrar Novo Convenio';

        $pesquisa = 1;

        $convenios  = Convenio::select('convenio.*',DB::raw('DATE_FORMAT(dtcad,"%d-%m-%Y") as dtcad'))
        ->where('nome', 'like', '%'.$dataForm['texto'].'%')
        ->paginate($this->totalPage);

        return view('cadastros.convenio.create-edit',compact('title', 'convenios', 'pesquisa') );
    }
}
