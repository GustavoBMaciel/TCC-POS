<?php

namespace App\Http\Controllers\Cadastros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cadastros\Conrec;
use App\Models\Cadastros\Cliente;
use App\Models\Cadastros\Tbprofissional;
use App\Http\Requests\Cadastros\ConrecFormRequest;
use App\Http\Requests\Cadastros\ConrecConsultaFormRequest;
use App\Http\Controllers\Auth;
use DB;

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

class ConrecController extends Controller
{
    private $conrec;
    private $totalPage = 20;

    public function __construct(Conrec $conrec)
    {
        $this->middleware('auth');

        $this->conrec = $conrec;
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

        $clientes = Cliente::select('nome', 'Cod')->get();

        $profissoes = Tbprofissional::select('cdProfissional', 'dsNomeMedico')->get();

        $conrecs = DB::table('conrec')
            ->join('cliente', 'cliente.Cod', '=', 'conrec.CLIENTE')
            ->join('tbprofissional', 'conrec.cdProfissional', '=', 'tbprofissional.cdProfissional')
            ->select(
                'cliente.*',
                'conrec.*',
                DB::raw('DATE_FORMAT(DATA,"%d-%m-%Y") as DATA'),
                DB::raw('DATE_FORMAT(DTPAG,"%d-%m-%Y") as DTPAG'),
                DB::raw('DATE_FORMAT(DTVENC,"%d-%m-%Y") as DTVENC'),
                'tbprofissional.*'
            )
            ->get();

        //*dd($conrecs);

        $totalRecebido = 0.00;
        $totalReceber = 0.00;

        //dd($caixas);
        foreach ($conrecs as $conrec) {
            if ($conrec->PAGO == "S") {
                $totalRecebido = $totalRecebido + $conrec->Valor_Pago;
            } else {
                $totalReceber = $totalReceber + $conrec->VALOR;
            }
        }

        return view('cadastros.conrec.create-edit', compact('title', 'clientes', 'conrecs', 'totalRecebido', 'totalReceber', 'profissoes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConrecFormRequest $request)
    {
        $dataForm = $request->all();

        //dd($dataForm);

        $idCliente = Cliente::select('nome')->where('Cod', $dataForm['CLIENTE'])->plucK('nome');

        //*dd($idCliente);

        $insert = $this->conrec->create([
            'CLIENTE'        =>  $dataForm['CLIENTE'],
            'DATA'           =>  $dataForm['DATA'],
            'DTPAG'          =>  $dataForm['DTPAG'],
            'DTVENC'         =>  $dataForm['DTVENC'],
            'VALOR'          =>  $dataForm['VALOR'],
            'PAGO'           =>  $dataForm['PAGO'],
            'Nome'           =>  $idCliente[0],
            'Valor_Pago'     =>  $dataForm['Valor_Pago'],
            'cdProfissional' =>  $dataForm['cdProfissional'],
        ]);
        if ($insert) {
            return redirect()->route('conrec.create');
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
    public function update(Request $request, $id)
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
        $agendaDestroy = DB::table('conrec')->where('NUMERO', $id)->delete();

        if ($agendaDestroy)
            return redirect()->route('conrec.create');
        else
            return redirect()->route('conrec.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pesquisa(ConrecConsultaFormRequest $request)
    {
        $dataForm = $request->all();

        $title = 'Cadastrar Novo agendas';

        $clientes = Cliente::select('nome', 'cod')->get();

        if ($dataForm['filtroProfissional'] != null) {
            $conrecs = DB::table('conrec')
                ->join('cliente', 'cliente.Cod', '=', 'conrec.CLIENTE')
                ->join('tbprofissional', 'conrec.cdProfissional', '=', 'tbprofissional.cdProfissional')
                ->select(
                    'cliente.*',
                    'conrec.*',
                    DB::raw('DATE_FORMAT(DATA,"%d-%m-%Y") as DATA'),
                    DB::raw('DATE_FORMAT(DTPAG,"%d-%m-%Y") as DTPAG'),
                    DB::raw('DATE_FORMAT(DTVENC,"%d-%m-%Y") as DTVENC'),
                    'tbprofissional.*'
                )
                ->where('conrec.cdProfissional', '=', $dataForm['filtroProfissional'])
                ->whereBetween('conrec.DATA', [$dataForm['filtroDataInicio'], $dataForm['filtroDataFim']])
                ->get();
        } else {
            $conrecs = DB::table('conrec')
                ->join('cliente', 'cliente.Cod', '=', 'conrec.CLIENTE')
                ->join('tbprofissional', 'conrec.cdProfissional', '=', 'tbprofissional.cdProfissional')
                ->select(
                    'cliente.*',
                    'conrec.*',
                    DB::raw('DATE_FORMAT(DATA,"%d-%m-%Y") as DATA'),
                    DB::raw('DATE_FORMAT(DTPAG,"%d-%m-%Y") as DTPAG'),
                    DB::raw('DATE_FORMAT(DTVENC,"%d-%m-%Y") as DTVENC'),
                    'tbprofissional.*'
                )
                ->whereBetween('conrec.DATA', [$dataForm['filtroDataInicio'], $dataForm['filtroDataFim']])
                ->get();
        }

        //*dd($conrecs);

        $totalRecebido = 0.00;
        $totalReceber = 0.00;

        //dd($caixas);
        foreach ($conrecs as $conrec) {
            if ($conrec->PAGO == "S") {
                $totalRecebido = $totalRecebido + $conrec->Valor_Pago;
            } else {
                $totalReceber = $totalReceber + $conrec->VALOR;
            }
        }

        return view('cadastros.conrec.create-edit', compact('title', 'clientes', 'conrecs', 'totalRecebido', 'totalReceber', 'profissoes'));
    }
}
