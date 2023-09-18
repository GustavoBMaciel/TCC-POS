<?php

namespace App\Http\Controllers\Cadastros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cadastros\Caixa;
use App\Models\Cadastros\Cliente;
use App\Models\Cadastros\Tbprofissional;
use App\Http\Requests\Cadastros\CaixaFormRequest;
use App\Http\Requests\Cadastros\CaixaConsultaFormRequest;
use App\Http\Controllers\Auth;
use DB;

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

class CaixaController extends Controller
{
    private $caixa;
    private $totalPage = 20;

    public function __construct(Caixa $caixa)
    {
        $this->middleware('auth');

        $this->caixa = $caixa;
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
        $title = 'Cadastrar Novo agendas';

        $clientes = Cliente::select('nome', 'cod')->get();

        $profissoes = Tbprofissional::select('cdProfissional', 'dsNomeMedico')->get();

        $caixas = DB::table('caixa')
            ->join('cliente', 'cliente.Cod', '=', 'caixa.Cod_Clifor')
            ->join('tbprofissional', 'caixa.cdProfissional', '=', 'tbprofissional.cdProfissional')
            ->select('cliente.*', 'caixa.*', DB::raw('DATE_FORMAT(Data,"%d-%m-%Y") as Data'), 'tbprofissional.*')->get();

        $total = 0.00;
        $credito = 0.00;
        $debito = 0.00;

        //dd($caixas);
        foreach ($caixas as $caixa) {
            if ($caixa->Tipo == "C") {
                $credito = $credito + $caixa->Valor;
            } else {
                $debito = $debito + $caixa->Valor;
            }
        }

        $total = $credito - $debito;


        //*dd($caixas);

        return view('cadastros.caixa.create-edit', compact('title', 'clientes', 'caixas', 'profissoes', 'total'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CaixaFormRequest $request)
    {
        $dataForm = $request->all();

        //dd($dataForm);

        $idCliente = Cliente::select('Cod')->where('nome', $dataForm['Nome_Clifor'])->plucK('Cod');

        //*dd($idCliente);

        $insert = $this->caixa->create([
            'Cod_Clifor'     =>  $idCliente[0],
            'Data'           =>  $dataForm['Data'],
            'Valor'          =>  $dataForm['Valor'],
            'Tipo'           =>  $dataForm['tipo'],
            'Nome_Clifor'    =>  $dataForm['Nome_Clifor'],
            'cdProfissional' =>  $dataForm['cdProfissional']
        ]);
        if ($insert) {
            return redirect()->route('caixa.create');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CaixaFormRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agendaDestroy = DB::table('caixa')->where('Num_Sequencial', $id)->delete();

        if ($agendaDestroy)
            return redirect()->route('caixa.create');
        else
            return redirect()->route('caixa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pesquisa(CaixaConsultaFormRequest $request)
    {
        $dataForm = $request->all();

        $title = 'Cadastrar Novo agendas';

        $clientes = Cliente::select('nome', 'cod')->get();

        $profissoes = TbtipoAgendamento::select('cdProfissional', 'nome')->get();

        if ($dataForm['filtroProfissional'] != null) {
            $caixas = DB::table('caixa')
                ->join('cliente', 'cliente.Cod', '=', 'caixa.Cod_Clifor')
                ->join('tbprofissional', 'caixa.cdProfissional', '=', 'tbprofissional.cdProfissional')
                ->select('cliente.*', 'caixa.*', DB::raw('DATE_FORMAT(Data,"%d-%m-%Y") as Data'), 'tbprofissional.*')
                ->where('caixa.cdProfissional', '=', $dataForm['filtroProfissional'])
                ->whereBetween('caixa.Data', [$dataForm['filtroDataInicio'], $dataForm['filtroDataFim']])
                ->get();
        } else {
            $caixas = DB::table('caixa')
                ->join('cliente', 'cliente.Cod', '=', 'caixa.Cod_Clifor')
                ->join('tbprofissional', 'caixa.cdProfissional', '=', 'tbprofissional.cdProfissional')
                ->select('cliente.*', 'caixa.*', DB::raw('DATE_FORMAT(Data,"%d-%m-%Y") as Data'), 'tbprofissional.*')
                ->whereBetween('caixa.Data', [$dataForm['filtroDataInicio'], $dataForm['filtroDataFim']])
                ->get();
        }
        
        $total = 0.00;
        $credito = 0.00;
        $debito = 0.00;

        //dd($caixas);
        foreach ($caixas as $caixa) {
            if ($caixa->Tipo == "C") {
                $credito = $credito + $caixa->Valor;
            } else {
                $debito = $debito + $caixa->Valor;
            }
        }

        $total = $credito - $debito;


        //*dd($caixas);

        return view('cadastros.caixa.create-edit', compact('title', 'clientes', 'caixas', 'profissoes', 'total'));
    }
}
