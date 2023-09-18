<?php

namespace App\Http\Controllers\Cadastros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cadastros\Anamnese;
use App\Models\Cadastros\Cliente;
use App\Models\Cadastros\Tbprofissional;
use App\Http\Requests\Cadastros\ClienteFormRequest;
use App\Http\Controllers\Auth;
use DB;
use PDF;

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

class AnamneseController extends Controller
{
    private $anamnese;
    private $totalPage = 20;

    public function __construct(Anamnese $anamnese)
    {
        $this->middleware('auth');

        $this->anamnese = $anamnese;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Listagem de Anamenses';

        $anamneses = $this->anamnese->paginate($this->totalPage);
        return view('cadastros.anamnese.index', compact('anamneses', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastrar Nova Anamnese';

        $clientes = Cliente::select('nome', 'Cod')->get();

        $profissoes = Tbprofissional::select('dsNomeMedico', 'cdProfissional')->get();

        return view('cadastros.anamnese.create-edit', compact('title', 'clientes', 'profissoes'));
    
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
    
        //dd($dataForm );

        $insert = $this->anamnese->create($dataForm);
        if ($insert)
        {
          return redirect()->route('anamnese.index');
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
        $anamneseShow = DB::table('anamnese')->where('cdCodigo', $id)->get();

        $title = "Visualizando Anamnese: {$anamneseShow[0]->cdCodigo}";
    
        return view('cadastros.anamnese.show', compact('title', 'anamneseShow'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $anamneseEdit = DB::table('anamneses')
                        ->join('cliente', 'anamneses.CodigoPaciente', '=', 'cliente.Cod')
                        ->join('tbprofissional', 'anamneses.cdProfissional', '=', 'tbprofissional.cdProfissional')
                        ->select('anamneses.*',DB::raw('DATE_FORMAT(data,"%Y-%m-%d") as data'),'cliente.nome as nome', 'tbprofissional.dsNomeMedico as medico')
                        ->where('cdCodigo', $id)->get();

                        //dd($anamneseEdit);

        $anamnesees = $this->anamnese->paginate($this->totalPage);

        $clientes = Cliente::select('nome', 'Cod')->get();

        $profissoes = Tbprofissional::select('dsNomeMedico', 'cdProfissional')->get();

        $title = "Editar Anamnese: {$anamneseEdit[0]->cdCodigo}";
    
        return view('cadastros.anamnese.create-edit', compact('title', 'anamneseEdit', 'anamnesees', 'clientes', 'profissoes'));
   
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

        //dd($dataForm);

        $anamneseEditado = DB::table('anamnese')->where('cdCodigo', $id)->update($dataForm);
    
        if ( $anamneseEditado )
        return redirect()->route('anamnese.index');
        else
        return redirect()->route('anamnese.edit', $id)->with(['errors' => 'Falha ao editar']);
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $anamneseDestroy = DB::table('anamnese')->where('cdCodigo', $id)->delete();

        if ( $anamneseDestroy )
        return redirect()->route('anamnese.index');
        else
        return redirect()->route('anamnese.show', $id)->with(['errors' => 'Falha ao deletar']);
    
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($id)
    {
        $anamnesePDF = DB::table('anamneses')
                        ->join('cliente', 'anamneses.CodigoPaciente', '=', 'cliente.Cod')
                        ->join('tbprofissional', 'anamneses.cdProfissional', '=', 'tbprofissional.cdProfissional')
                        ->select('anamneses.*',DB::raw('DATE_FORMAT(data,"%d-%m-%Y") as data'),'cliente.nome as nome', 'tbprofissional.dsNomeMedico as medico')
                        ->where('cdCodigo', $id)->get();

        //dd($clientePDF);

        $data = ['title' => 'Dados da Anamnese'];
        $pdf = PDF::loadView('cadastros.anamnese.myPDF', $data, compact('anamnesePDF'));

        return $pdf->stream('anamnese.pdf');
    }
}
