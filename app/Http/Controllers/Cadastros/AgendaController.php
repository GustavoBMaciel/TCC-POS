<?php

namespace App\Http\Controllers\Cadastros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cadastros\Agenda;
use App\Models\Cadastros\Convenio;
use App\Models\Cadastros\TbtipoAgendamento;
use App\Models\Cadastros\TbstatusAgenda;
use App\Models\Cadastros\Cliente;
use App\Models\Cadastros\Tbprofissional;
use App\Http\Requests\Cadastros\AgendaFormRequest;
use App\Http\Controllers\Auth;
use DB;

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

class AgendaController extends Controller
{
    private $agenda;
    private $totalPage = 20;

    public function __construct(Agenda $agenda)
    {
        $this->middleware('auth');

        $this->agenda = $agenda;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Listagem da Agenda';

        $agendas = DB::table('agenda', DB::raw('DATE_FORMAT(data,"%d-%m-%Y") as data'))
            ->join('tbstatusagenda', 'agenda.realizado', '=', 'tbstatusagenda.dsSimbolo')
            ->paginate($this->totalPage);

        return view('cadastros.agenda.index', compact('agendas', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastrar Novo agendas';

        $convenios = Convenio::select('nome', 'cod')->get();

        $clientes = Cliente::select('nome', 'cod')->get();

        $tipos = TbtipoAgendamento::select('nome', 'cdTipoAgendamento')->get();

        $profissoes = Tbprofissional::select('dsNomeMedico', 'cdProfissional')->where('dsAtivo', 'S')->get();

        $status = TbstatusAgenda::select('nome', 'dsSimbolo', 'dsCor')->get();

        $agendas = DB::table('agenda')
            ->join('tbstatusagenda', 'agenda.realizado', '=', 'tbstatusagenda.dsSimbolo')
            ->join('tbtipoagendamento', 'agenda.tipo', '=', 'tbtipoagendamento.cdTipoAgendamento')
            ->join('tbprofissional', 'agenda.cdProfissional', '=', 'tbprofissional.cdProfissional')
            ->select('agenda.*', DB::raw('DATE_FORMAT(data,"%d-%m-%Y") as data'), 'tbstatusagenda.*', 'tbtipoagendamento.nome as tipoNome', 'tbprofissional.*')
            ->paginate($this->totalPage);

        //dd($agendas);

        return view('cadastros.agenda.create-edit', compact('title', 'sexos', 'convenios', 'tipos', 'profissoes', 'clientes', 'agendas', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgendaFormRequest $request)
    {
        $dataForm = $request->all();

        
        $idCliente = Cliente::select('Cod')->where('nome', $dataForm['nomePaciente'])->plucK('Cod');

        //*dd($idCliente);

        $agendas = DB::table('agenda')
        ->select('agenda.*', DB::raw('DATE_FORMAT(data,"%d-%m-%Y") as data'))
        ->where([
            ['data', '=', $dataForm['data']],
            ['horario', '=', $dataForm['horario']],
            ['agenda.cdProfissional', '=', $dataForm['cdProfissional']],
        ])->get();

        $arrayLength = count($agendas, COUNT_RECURSIVE);

        //dd($arrayLength);

        if ( $arrayLength > 0)
        {
          return redirect()->route('agenda.create')->with(['errors' => 'O Profissional selecionado ja possui um agendamento para este horario nesta data!']);
        }

        $insert = $this->agenda->create([
            'codcli'         =>  $idCliente[0],
            'data'           =>  $dataForm['data'],
            'horario'        =>  $dataForm['horario'],
            'realizado'      =>  $dataForm['Status'],
            'tipo'           =>  $dataForm['tipo'],
            'nomePaciente'   =>  $dataForm['nomePaciente'],
            'nomeConvenio'   =>  $dataForm['nomeConvenio'],
            'fonePaciente'   =>  $dataForm['fonePaciente'],
            'cdProfissional' =>  $dataForm['cdProfissional']
        ]);
        if ($insert) {
            return redirect()->route('agenda.create');
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
        $agendaShow = DB::table('agenda.*', DB::raw('DATE_FORMAT(data,"%d-%m-%Y") as data'))->where('cod', $id)->get();

        $title = "Visualizando Agendamento: {$agendaShow[0]->nome}";

        return view('cadastros.agenda.show', compact('title', 'agendaShow'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agendaEdit = DB::table('agenda')
            ->join('tbstatusagenda', 'agenda.realizado', '=', 'tbstatusagenda.dsSimbolo')
            ->join('tbtipoagendamento', 'agenda.tipo', '=', 'tbtipoagendamento.cdTipoAgendamento')
            ->join('tbprofissional', 'agenda.cdProfissional', '=', 'tbprofissional.cdProfissional')
            ->select('agenda.*', DB::raw('DATE_FORMAT(data,"%Y-%m-%d") as data'), 'tbstatusagenda.*', 'tbtipoagendamento.nome as tipoNome', 'tbprofissional.*')
            ->where('cod', $id)->get();

        //dd($agendaEdit);

        $title = 'Editar Agendamento';

        $convenios = Convenio::select('nome', 'cod')->get();

        $clientes = Cliente::select('nome', 'cod')->get();

        $tipos = TbtipoAgendamento::select('nome', 'cdTipoAgendamento')->get();

        $profissoes = Tbprofissional::select('dsNomeMedico', 'cdProfissional')->where('dsAtivo', 'S')->get();

        $status = TbstatusAgenda::select('nome', 'dsSimbolo', 'dsCor')->get();

        $agendas = DB::table('agenda')
            ->join('tbstatusagenda', 'agenda.realizado', '=', 'tbstatusagenda.dsSimbolo')
            ->join('tbtipoagendamento', 'agenda.tipo', '=', 'tbtipoagendamento.cdTipoAgendamento')
            ->join('tbprofissional', 'agenda.cdProfissional', '=', 'tbprofissional.cdProfissional')
            ->select('agenda.*', DB::raw('DATE_FORMAT(data,"%d-%m-%Y") as data'), 'tbstatusagenda.*', 'tbtipoagendamento.nome as tipoNome', 'tbprofissional.*')
            ->paginate($this->totalPage);

        //dd($agendas);

        return view('cadastros.agenda.create-edit', compact('title', 'agendaEdit', 'convenios', 'tipos', 'profissoes', 'clientes', 'agendas', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AgendaFormRequest $request, $id)
    {
        $dataForm = $request->except(['_token', '_method']);

        //dd($dataForm );

        $idCliente = Cliente::select('Cod')->where('nome', $dataForm['nomePaciente'])->plucK('Cod');

        $agendaEditado = DB::table('agenda')->where('cod', $id)->update([
            'codcli'         =>  $idCliente[0],
            'data'           =>  $dataForm['data'],
            'horario'        =>  $dataForm['horario'],
            'realizado'      =>  $dataForm['Status'],
            'tipo'           =>  $dataForm['tipo'],
            'nomePaciente'   =>  $dataForm['nomePaciente'],
            'nomeConvenio'   =>  $dataForm['nomeConvenio'],
            'fonePaciente'   =>  $dataForm['fonePaciente'],
            'cdProfissional' =>  $dataForm['cdProfissional']
        ]);

        if ($agendaEditado)
            return redirect()->route('agenda.create');
        else
            return redirect()->route('agenda.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($id);
        $agendaDestroy = DB::table('agenda')->where('cod', $id)->delete();

        if ($agendaDestroy)
            return redirect()->route('agenda.create');
        else
            return redirect()->route('agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pesquisa(Request $request)
    {
        $dataForm = $request->all();

        $title = 'Cadastrar Novo agendas';

        $convenios = Convenio::select('nome', 'cod')->get();

        $clientes = Cliente::select('nome', 'cod')->get();

        $tipos = TbtipoAgendamento::select('nome', 'cdTipoAgendamento')->get();

        $profissoes = Tbprofissional::select('dsNomeMedico', 'cdProfissional')->where('dsAtivo', 'S')->get();

        $status = TbstatusAgenda::select('nome', 'dsSimbolo', 'dsCor')->get();

        if ($dataForm['filtroStatus'] != null && $dataForm['filtroProfissional'] != null) {
            $agendas = DB::table('agenda')
                ->join('tbstatusagenda', 'agenda.realizado', '=', 'tbstatusagenda.dsSimbolo')
                ->join('tbtipoagendamento', 'agenda.tipo', '=', 'tbtipoagendamento.cdTipoAgendamento')
                ->join('tbprofissional', 'agenda.cdProfissional', '=', 'tbprofissional.cdProfissional')
                ->select('agenda.*', DB::raw('DATE_FORMAT(data,"%d-%m-%Y") as data'), 'tbstatusagenda.*', 'tbtipoagendamento.nome as tipoNome', 'tbprofissional.*')
                ->where([
                    ['realizado', '=', $dataForm['filtroStatus']],
                    ['agenda.cdProfissional', '=', $dataForm['filtroProfissional']],
                ])->get();
        } elseif ($dataForm['filtroStatus'] != null) {
            $agendas = DB::table('agenda')
                ->join('tbstatusagenda', 'agenda.realizado', '=', 'tbstatusagenda.dsSimbolo')
                ->join('tbtipoagendamento', 'agenda.tipo', '=', 'tbtipoagendamento.cdTipoAgendamento')
                ->join('tbprofissional', 'agenda.cdProfissional', '=', 'tbprofissional.cdProfissional')
                ->select('agenda.*', DB::raw('DATE_FORMAT(data,"%d-%m-%Y") as data'), 'tbstatusagenda.*', 'tbtipoagendamento.nome as tipoNome', 'tbprofissional.*')
                ->where([
                    ['realizado', '=', $dataForm['filtroStatus']],
                ])->get();
        } elseif ($dataForm['filtroProfissional'] != null) {
            $agendas = DB::table('agenda')
                ->join('tbstatusagenda', 'agenda.realizado', '=', 'tbstatusagenda.dsSimbolo')
                ->join('tbtipoagendamento', 'agenda.tipo', '=', 'tbtipoagendamento.cdTipoAgendamento')
                ->join('tbprofissional', 'agenda.cdProfissional', '=', 'tbprofissional.cdProfissional')
                ->select('agenda.*', DB::raw('DATE_FORMAT(data,"%d-%m-%Y") as data'), 'tbstatusagenda.*', 'tbtipoagendamento.nome as tipoNome', 'tbprofissional.*')
                ->where([
                    ['agenda.cdProfissional', '=', $dataForm['filtroProfissional']],
                ])->get();
        } elseif ($dataForm['filtroData'] != null) {
            $agendas = DB::table('agenda')
                ->join('tbstatusagenda', 'agenda.realizado', '=', 'tbstatusagenda.dsSimbolo')
                ->join('tbtipoagendamento', 'agenda.tipo', '=', 'tbtipoagendamento.cdTipoAgendamento')
                ->join('tbprofissional', 'agenda.cdProfissional', '=', 'tbprofissional.cdProfissional')
                ->select('agenda.*', DB::raw('DATE_FORMAT(data,"%d-%m-%Y") as data'), 'tbstatusagenda.*', 'tbtipoagendamento.nome as tipoNome', 'tbprofissional.*')
                ->where([
                    ['agenda.data', '=', $dataForm['filtroData']],
                ])->get();
        } else {
            $agendas = DB::table('agenda')
                ->join('tbstatusagenda', 'agenda.realizado', '=', 'tbstatusagenda.dsSimbolo')
                ->join('tbtipoagendamento', 'agenda.tipo', '=', 'tbtipoagendamento.cdTipoAgendamento')
                ->join('tbprofissional', 'agenda.cdProfissional', '=', 'tbprofissional.cdProfissional')
                ->select('agenda.*', DB::raw('DATE_FORMAT(data,"%d-%m-%Y") as data'), 'tbstatusagenda.*', 'tbtipoagendamento.nome as tipoNome', 'tbprofissional.*')
                ->paginate($this->totalPage);
        }


        //dd($agendas);

        return view('cadastros.agenda.create-edit', compact('title', 'sexos', 'convenios', 'tipos', 'profissoes', 'clientes', 'agendas', 'status'));
    }
}
