<?php

namespace App\Http\Controllers\Cadastros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cadastros\Medicamento;
use App\Http\Requests\Cadastros\MedicamentoFormRequest;
use App\Http\Controllers\Auth;
use DB;

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
    }

class MedicamentoController extends Controller
{
    private $medicamento;
    private $totalPage = 5;
  
    public function __construct(Medicamento $medicamento)
    {
        $this->middleware('auth');
  
      $this->medicamento = $medicamento;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Listagem de Medicamento';

        $medicamentos = $this->medicamento->paginate($this->totalPage);
        return view ('cadastros.medicamento.create-edit', compact('medicamentos', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastrar Novo Medicamento';

        $administracoes = ['ORAL', 'SUBCUTÂNEA', 'ENDOVENOSO','INTRAMUSCULAR','INALATÓRIO','TÓPICO'];

        $medicamentos = $this->medicamento->paginate($this->totalPage);

        return view('cadastros.medicamento.create-edit',compact('title', 'medicamentos', 'administracoes') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MedicamentoFormRequest $request)
    {
        $dataForm = $request->except(['_token', '_method']);

        //dd($dataForm);

        $insert = DB::table('medicamento')->insert($dataForm);

        if ($insert)
        {
          return redirect()->route('medicamento.create');
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
        $medicamentoShow = DB::table('medicamento')->where('codigo', $id)->get();

        $title = "Visualizando Medicamento: {$medicamentoShow[0]->nome}";
    
        return view('cadastros.medicamento.show', compact('title', 'medicamentoShow'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
        $medicamentoEdit = DB::table('medicamento')->where('codigo', $id)->get();

        $administracoes = ['ORAL', 'SUBCUTÂNEA', 'ENDOVENOSO','INTRAMUSCULAR','INALATÓRIO','TÓPICO'];
        
        $medicamentos = $this->medicamento->paginate($this->totalPage);

        $title = "Editar Medicamento: {$medicamentoEdit[0]->nome}";
    
        return view('cadastros.medicamento.create-edit', compact('title', 'medicamentoEdit', 'medicamentos', 'administracoes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MedicamentoFormRequest $request, $id)
    {
        $dataForm = $request->except(['_token', '_method']);

        $medicamentoEditado = DB::table('medicamento')->where('codigo', $id)->update($dataForm);
    
        if ( $medicamentoEditado )
        return redirect()->route('medicamento.create');
        else
        return redirect()->route('medicamento.create'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medicamentoDestroy = DB::table('medicamento')->where('codigo', $id)->delete();

        if ( $medicamentoDestroy )
        return redirect()->route('medicamento.create');
        else
        return redirect()->route('medicamento.create');
    }

    public function pesquisa(Request $request)
    {
        $dataForm = $request->all();

        //dd($dataForm);

        $title = 'Cadastrar Novo Medicamento';

        $pesquisa = 1;

        $administracoes = ['ORAL', 'SUBCUTÂNEA', 'ENDOVENOSO','INTRAMUSCULAR','INALATÓRIO','TÓPICO'];

        $medicamentos = $this->medicamento
        ->where('nomeGenerico', 'like', '%'.$dataForm['texto'].'%')
        ->orWhere('nomeFabrica', 'like', '%'.$dataForm['texto'].'%')
        ->paginate($this->totalPage);

        return view('cadastros.medicamento.create-edit',compact('title', 'medicamentos', 'administracoes', 'pesquisa') );
    }
}
