<?php

namespace App\Http\Controllers\Cadastros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cadastros\Conpag;
use App\Models\Cadastros\Fornecedor;
use App\Models\Cadastros\Tbprofissional;
use App\Http\Requests\Cadastros\ConpagFormRequest;
use App\Http\Requests\Cadastros\ConpagConsultaFormRequest;
use App\Http\Controllers\Auth;
use DB;

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

class ConpagController extends Controller
{
    private $conpag;
    private $totalPage = 20;

    public function __construct(Conpag $conpag)
    {
        $this->middleware('auth');

        $this->conpag = $conpag;
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

        $fornecedores = Fornecedor::select('nome', 'cod')->get();

        $profissoes = Tbprofissional::select('cdProfissional', 'dsNomeMedico')->get();

        $conpags = DB::table('conpag')
            ->join('fornecedor', 'fornecedor.cod', '=', 'conpag.CODFOR')
            ->join('tbprofissional', 'conpag.cdProfissional', '=', 'tbprofissional.cdProfissional')
            ->select(
                'fornecedor.*',
                'conpag.*',
                DB::raw('DATE_FORMAT(DATA,"%d-%m-%Y") as DATA'),
                DB::raw('DATE_FORMAT(DTPAG,"%d-%m-%Y") as DTPAG'),
                DB::raw('DATE_FORMAT(DTVENC,"%d-%m-%Y") as DTVENC'),
                'tbprofissional.*'
            )->get();

        //*dd($conpags);

        $totalRecebido = 0.00;
        $totalReceber = 0.00;

        //dd($caixas);
        foreach ($conpags as $conpag) {
            if ($conpag->PAGO == "S") {
                $totalRecebido = $totalRecebido + $conpag->Valor_Pago;
            } else {
                $totalReceber = $totalReceber + $conpag->VALOR;
            }
        }

        return view('cadastros.conpag.create-edit', compact('title', 'fornecedores', 'conpags', 'profissoes', 'totalRecebido', 'totalReceber'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConpagFormRequest $request)
    {

        $dataForm = $request->all();

        //dd($dataForm);

        $idFornecedor = Fornecedor::select('nome')->where('cod', $dataForm['CODFOR'])->plucK('nome');

        //dd($idFornecedor);

        $insert = $this->conpag->create([
            'CODFOR'         =>  $dataForm['CODFOR'],
            'DATA'           =>  $dataForm['DATA'],
            'DTPAG'          =>  $dataForm['DTPAG'],
            'DTVENC'         =>  $dataForm['DTVENC'],
            'VALOR'          =>  $dataForm['VALOR'],
            'PAGO'           =>  $dataForm['PAGO'],
            'Nome'           =>  $idFornecedor[0],
            'Valor_Pago'     =>  $dataForm['Valor_Pago'],
            'cdProfissional' =>  $dataForm['cdProfissional'],
        ]);
        if ($insert) {
            return redirect()->route('conpag.create');
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
        $agendaDestroy = DB::table('conpag')->where('NUMERO', $id)->delete();

        if ($agendaDestroy)
            return redirect()->route('conpag.create');
        else
            return redirect()->route('conpag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pesquisa(ConpagConsultaFormRequest $request)
    {
        $dataForm = $request->all();

        $title = 'Cadastrar Novo agendas';

        $fornecedores = Fornecedor::select('nome', 'cod')->get();

        $profissoes = Tbprofissional::select('cdProfissional', 'dsNomeMedico')->get();

        if ($dataForm['filtroProfissional'] != null) {
            $conpags = DB::table('conpag')
                ->join('fornecedor', 'fornecedor.cod', '=', 'conpag.CODFOR')
                ->join('tbprofissional', 'conpag.cdProfissional', '=', 'tbprofissional.cdProfissional')
                ->select(
                    'fornecedor.*',
                    'conpag.*',
                    DB::raw('DATE_FORMAT(DATA,"%d-%m-%Y") as DATA'),
                    DB::raw('DATE_FORMAT(DTPAG,"%d-%m-%Y") as DTPAG'),
                    DB::raw('DATE_FORMAT(DTVENC,"%d-%m-%Y") as DTVENC'),
                    'tbprofissional.*'
                )
                ->where('conpag.cdProfissional', '=', $dataForm['filtroProfissional'])
                ->whereBetween('conpag.DATA', [$dataForm['filtroDataInicio'], $dataForm['filtroDataFim']])
                ->get();
        } else {
            $conpags = DB::table('conpag')
                ->join('fornecedor', 'fornecedor.cod', '=', 'conpag.CODFOR')
                ->join('tbprofissional', 'conpag.cdProfissional', '=', 'tbprofissional.cdProfissional')
                ->select(
                    'fornecedor.*',
                    'conpag.*',
                    DB::raw('DATE_FORMAT(DATA,"%d-%m-%Y") as DATA'),
                    DB::raw('DATE_FORMAT(DTPAG,"%d-%m-%Y") as DTPAG'),
                    DB::raw('DATE_FORMAT(DTVENC,"%d-%m-%Y") as DTVENC'),
                    'tbprofissional.*'
                )
                ->whereBetween('conpag.DATA', [$dataForm['filtroDataInicio'], $dataForm['filtroDataFim']])
                ->get();
        }

        $totalRecebido = 0.00;
        $totalReceber = 0.00;

        foreach ($conpags as $conpag) {
            if ($conpag->PAGO == "S") {
                $totalRecebido = $totalRecebido + $conpag->Valor_Pago;
            } else {
                $totalReceber = $totalReceber + $conpag->VALOR;
            }
        }

        return view('cadastros.conpag.create-edit', compact('title', 'fornecedores', 'conpags', 'profissoes', 'totalRecebido', 'totalReceber'));
    }
}
