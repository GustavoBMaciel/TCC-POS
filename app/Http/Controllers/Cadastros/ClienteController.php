<?php

namespace App\Http\Controllers\Cadastros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cadastros\Cliente;
use App\Models\Cadastros\Convenio;
use App\Models\Cadastros\Tipo;
use App\Models\Cadastros\Profissao;
use App\Models\Cadastros\Agenda;
use App\Models\Cadastros\Anamnese;
use App\Models\Cadastros\Tbprofissional;
use App\Models\Cadastros\TbtipoAgendamento;
use App\Http\Requests\Cadastros\ClienteFormRequest;
use App\Http\Controllers\Auth;
use DB;
use PDF;

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

class ClienteController extends Controller
{

    private $cliente;
    private $totalPage = 20;

    public function __construct(Cliente $cliente)
    {
        $this->middleware('auth');

        $this->cliente = $cliente;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Listagem de Clientes';

        //$clientes = $this->cliente->paginate($this->totalPage);

        $clientes = Cliente::select(
            'cliente.*',
            DB::raw('DATE_FORMAT(dtcad,"%d-%m-%Y") as dtcad'),
            DB::raw('DATE_FORMAT(dtnasc,"%d-%m-%Y") as dtnasc')
        )->paginate($this->totalPage);

        //dd($clientes);

        return view('cadastros.cliente.index', compact('clientes', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastrar Novo Clientes';

        $sexos = ['Feminino', 'Masculino'];

        $convenios = Convenio::select('nome', 'cod')->get();

        $tipos = Tipo::select('nome')->get();

        $profissoes = Profissao::select('nome', 'codigo')->get();

        return view('cadastros.cliente.create-edit', compact('title', 'sexos', 'convenios', 'tipos', 'profissoes', 'agendamentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteFormRequest $request)
    {
        $dataForm = $request->all();

        //dd($dataForm);

        if (isset($dataForm['foto'])) {
            $imageName = $request->id . '.' .
                $request->file('foto')->getClientOriginalName();
            $image = $request->file('foto')->move(base_path() . '\public\fotoPacientes' . $dataForm['nome'], $imageName);
        }
        if (isset($dataForm['localFoto1'])) {
            $imageNameFoto1 = $request->id . '.' .
                $request->file('localFoto1')->getClientOriginalName();
            $image = $request->file('localFoto1')->move(base_path() . '\public\fotoPacientes' . $dataForm['nome'], $imageNameFoto1);
        }
        if (isset($dataForm['localFoto2'])) {
            $imageNameFoto2 = $request->id . '.' .
                $request->file('localFoto2')->getClientOriginalName();
            $image = $request->file('localFoto2')->move(base_path() . '\public\fotoPacientes' . $dataForm['nome'], $imageNameFoto2);
        }
        if (isset($dataForm['localFoto3'])) {
            $imageNameFoto3 = $request->id . '.' .
                $request->file('localFoto3')->getClientOriginalName();
            $image = $request->file('localFoto3')->move(base_path() . '\public\fotoPacientes' . $dataForm['nome'], $imageNameFoto3);
        }
        if (isset($dataForm['localFoto4'])) {
            $imageNameFoto4 = $request->id . '.' .
                $request->file('localFoto4')->getClientOriginalName();
            $image = $request->file('localFoto4')->move(base_path() . '\public\fotoPacientes' . $dataForm['nome'], $imageNameFoto4);
        }
        if (isset($dataForm['localFoto5'])) {
            $imageNameFoto5 = $request->id . '.' .
                $request->file('localFoto5')->getClientOriginalName();
            $image = $request->file('localFoto5')->move(base_path() . '\public\fotoPacientes' . $dataForm['nome'], $imageNameFoto5);
        }
        if (isset($dataForm['localFoto6'])) {
            $imageNameFoto6 = $request->id . '.' .
                $request->file('localFoto6')->getClientOriginalName();
            $image = $request->file('localFoto6')->move(base_path() . '\public\fotoPacientes' . $dataForm['nome'], $imageNameFoto6);
        }
        if (isset($dataForm['localFoto7'])) {
            $imageNameFoto7 = $request->id . '.' .
                $request->file('localFoto7')->getClientOriginalName();
            $image = $request->file('localFoto7')->move(base_path() . '\public\fotoPacientes' . $dataForm['nome'], $imageNameFoto7);
        }
        if (isset($dataForm['localFoto8'])) {
            $imageNameFoto8 = $request->id . '.' .
                $request->file('localFoto8')->getClientOriginalName();
            $image = $request->file('localFoto8')->move(base_path() . '\public\fotoPacientes' . $dataForm['nome'], $imageNameFoto8);
        }

        //dd($dataForm);

        $dataForm['ativo'] = (!isset($dataForm['ativo'])) ? 0 : 1;

        if ($dataForm['sexo'] = 'Masculino') {
            $dataForm['sexo'] = 1;
        } else {
            $dataForm['sexo'] = 0;
        }

        $insert = $this->cliente->create([
            'nome'             =>  $dataForm['nome'],
            'dtcad'            =>  $dataForm['dtcad'],
            'dtnasc'           =>  $dataForm['dtnasc'],
            'Responsavel'      =>  $dataForm['Responsavel'],
            'rua'              =>  $dataForm['rua'],
            'numero'           =>  $dataForm['numero'],
            'compl'            =>  $dataForm['compl'],
            'Bairro'           =>  $dataForm['Bairro'],
            'CEP'              =>  $dataForm['CEP'],
            'Cidade'           =>  $dataForm['Cidade'],
            'uf'               =>  $dataForm['uf'],
            'fone'             =>  $dataForm['fone'],
            'celular'          =>  $dataForm['celular'],
            'Obs'              =>  $dataForm['Obs'],
            'ativo'            =>  $dataForm['ativo'],
            'sexo'             =>  $dataForm['sexo'],
            'convenio'         =>  $dataForm['convenio'],
            'tipo'             =>  $dataForm['tipo'],
            'foto'             => (!isset($imageName)) ? "-" : $imageName,
            'profissao'        =>  $dataForm['profissao'],
            'dsEmail'          =>  $dataForm['dsEmail'],
            'dsCPF'            =>  $dataForm['dsCPF'],
            'dsCartaoConvenio' =>  $dataForm['dsCartaoConvenio']
        ]);
        if ($insert) {

            $idCliente = Cliente::select('Cod')->max('Cod');

            $insertFoto = DB::table('fotos')->insert([
                'codcliente' =>  $idCliente,
                'localFoto1' => (!isset($imageNameFoto1)) ? "-" : $imageNameFoto1,
                'obsFoto1'   =>  $dataForm['obsFoto1'],
                'localFoto2' => (!isset($imageNameFoto2)) ? "-" : $imageNameFoto2,
                'obsFoto2'   =>  $dataForm['obsFoto2'],
                'localFoto3' => (!isset($imageNameFoto3)) ? "-" : $imageNameFoto3,
                'obsFoto3'   =>  $dataForm['obsFoto3'],
                'localFoto4' => (!isset($imageNameFoto4)) ? "-" : $imageNameFoto4,
                'obsFoto4'   =>  $dataForm['obsFoto4'],
                'localFoto5' => (!isset($imageNameFoto5)) ? "-" : $imageNameFoto5,
                'obsFoto5'   =>  $dataForm['obsFoto5'],
                'localFoto6' => (!isset($imageNameFoto6)) ? "-" : $imageNameFoto6,
                'obsFoto6'   =>  $dataForm['obsFoto6'],
                'localFoto7' => (!isset($imageNameFoto7)) ? "-" : $imageNameFoto7,
                'obsFoto7'   =>  $dataForm['obsFoto7'],
                'localFoto8' => (!isset($imageNameFoto8)) ? "-" : $imageNameFoto8,
                'obsFoto8'   =>  $dataForm['obsFoto8']
            ]);
            if ($insertFoto)
                return redirect()->route('cliente.index');
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
        $clienteShow = DB::table('cliente')->where('Cod', $id)->get();

        $profissional = Tbprofissional::select('dsNomeMedico', 'cdProfissional')->get();

        $tipos = TbtipoAgendamento::select('nome', 'cdTipoAgendamento')->get();

        //dd($clienteShow[]);

        $title = "Agendar Próxima Consulta do Cliente: {$clienteShow[0]->nome}";

        return view('cadastros.cliente.show', compact('title', 'clienteShow', 'profissional', 'tipos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clienteEdit = DB::table('cliente')
            ->join('fotos', 'cliente.Cod', '=', 'fotos.codCliente')
            ->select(
                'cliente.*',
                DB::raw('DATE_FORMAT(cliente.dtcad,"%Y-%m-%d") as dtcad'),
                DB::raw('DATE_FORMAT(cliente.dtnasc,"%Y-%m-%d") as dtnasc'),
                'fotos.*'
            )->where('Cod', $id)->get();

        //dd($clienteEdit);

        $convenioPaci = Convenio::select('nome')->where('cod', $clienteEdit[0]->convenio)->max('nome');

        $profissaoPaci = Profissao::select('nome')->where('codigo', $clienteEdit[0]->profissao)->max('nome');

        //dd($clienteEdit);

        $sexos = ['Feminino', 'Masculino'];

        $convenios = Convenio::select('nome', 'cod')->get();

        $tipos = Tipo::select('nome')->get();

        $profissoes = Profissao::select('nome', 'codigo')->get();

        $agendamentos = Agenda::select('agenda.*', DB::raw('DATE_FORMAT(data,"%d-%m-%Y") as date'))->where('codcli', $id)->get();

        $anamneses = Anamnese::select('anamneses.*', DB::raw('DATE_FORMAT(data,"%d-%m-%Y") as data'))->where('CodigoPaciente', $id)->get();

        $medicamentosItens = DB::table('tbmedicamentositens')
            ->join('medicamento', 'tbmedicamentositens.codMedicamento', '=', 'medicamento.codigo')
            ->join('tbmedicamentos', 'tbmedicamentos.cdMedicamentos', '=', 'tbmedicamentositens.codMedicamentos')
            ->join('cliente', 'tbmedicamentos.codCliente', '=', 'cliente.Cod')
            ->select('tbmedicamentositens.*', 'medicamento.*','tbmedicamentos.*', DB::raw('DATE_FORMAT(tbmedicamentos.data,"%d-%m-%Y") as data'), 'tbmedicamentos.usuario')
            ->where('cliente.Cod', $id)->get();

        $examesItens = DB::table('tbexamesitens')
            ->join('exames', 'tbexamesitens.codExame', '=', 'exames.Codigo')
            ->join('tbexames', 'tbexames.cdExames', '=', 'tbexamesitens.codExames')
            ->join('cliente', 'tbexames.codCliente', '=', 'cliente.Cod')
            ->select('tbexamesitens.*', 'exames.*','tbexames.*', DB::raw('DATE_FORMAT(tbexames.data,"%d-%m-%Y") as data'), 'tbexames.usuario')
            ->where('cliente.Cod', $id)->get();

        $title = "Editar Cliente: {$clienteEdit[0]->nome}";

        //dd($agendamentos);
        //dd($profissoes);

        return view('cadastros.cliente.create-edit', compact('title', 'clienteEdit', 'sexos', 'convenios', 'tipos', 'profissoes', 'agendamentos', 'anamneses', 'convenioPaci', 'profissaoPaci', 'medicamentosItens', 'examesItens'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteFormRequest $request, $id)
    {
        $dataForm = $request->except(['_token', '_method']);

        $clienteEdit = DB::table('cliente')
            ->join('fotos', 'cliente.Cod', '=', 'fotos.codCliente')
            ->select(
                'cliente.*',
                DB::raw('DATE_FORMAT(cliente.dtcad,"%Y-%m-%d") as dtcad'),
                DB::raw('DATE_FORMAT(cliente.dtnasc,"%Y-%m-%d") as dtnasc'),
                'fotos.*'
            )->where('Cod', $id)->get();

        //dd( $clienteEdit[0]->foto);

        if (isset($dataForm['foto'])) {
            $imageName = $request->id . '.' .
                $request->file('foto')->getClientOriginalName();
            $image = $request->file('foto')->move(base_path() . '\public\fotoPacientes' . $dataForm['nome'], $imageName);
        } else {
            $imageName = $clienteEdit[0]->foto;
        }
        if (isset($dataForm['localFoto1'])) {
            $imageNameFoto1 = $request->id . '.' .
                $request->file('localFoto1')->getClientOriginalName();
            $image = $request->file('localFoto1')->move(base_path() . '\public\fotoPacientes' . $dataForm['nome'], $imageNameFoto1);
        } else {
            $imageNameFoto1 = $clienteEdit[0]->localFoto1;
        }
        if (isset($dataForm['localFoto2'])) {
            $imageNameFoto2 = $request->id . '.' .
                $request->file('localFoto2')->getClientOriginalName();
            $image = $request->file('localFoto2')->move(base_path() . '\public\fotoPacientes' . $dataForm['nome'], $imageNameFoto2);
        } else {
            $imageNameFoto2 = $clienteEdit[0]->localFoto2;
        }
        if (isset($dataForm['localFoto3'])) {
            $imageNameFoto3 = $request->id . '.' .
                $request->file('localFoto3')->getClientOriginalName();
            $image = $request->file('localFoto3')->move(base_path() . '\public\fotoPacientes' . $dataForm['nome'], $imageNameFoto3);
        } else {
            $imageNameFoto3 = $clienteEdit[0]->localFoto3;
        }
        if (isset($dataForm['localFoto4'])) {
            $imageNameFoto4 = $request->id . '.' .
                $request->file('localFoto4')->getClientOriginalName();
            $image = $request->file('localFoto4')->move(base_path() . '\public\fotoPacientes' . $dataForm['nome'], $imageNameFoto4);
        } else {
            $imageNameFoto4 = $clienteEdit[0]->localFoto4;
        }
        if (isset($dataForm['localFoto5'])) {
            $imageNameFoto5 = $request->id . '.' .
                $request->file('localFoto5')->getClientOriginalName();
            $image = $request->file('localFoto5')->move(base_path() . '\public\fotoPacientes' . $dataForm['nome'], $imageNameFoto5);
        } else {
            $imageNameFoto5 = $clienteEdit[0]->localFoto5;
        }
        if (isset($dataForm['localFoto6'])) {
            $imageNameFoto6 = $request->id . '.' .
                $request->file('localFoto6')->getClientOriginalName();
            $image = $request->file('localFoto6')->move(base_path() . '\public\fotoPacientes' . $dataForm['nome'], $imageNameFoto6);
        } else {
            $imageNameFoto6 = $clienteEdit[0]->localFoto6;
        }
        if (isset($dataForm['localFoto7'])) {
            $imageNameFoto7 = $request->id . '.' .
                $request->file('localFoto7')->getClientOriginalName();
            $image = $request->file('localFoto7')->move(base_path() . '\public\fotoPacientes' . $dataForm['nome'], $imageNameFoto7);
        } else {
            $imageNameFoto7 = $clienteEdit[0]->localFoto7;
        }
        if (isset($dataForm['localFoto8'])) {
            $imageNameFoto8 = $request->id . '.' .
                $request->file('localFoto8')->getClientOriginalName();
            $image = $request->file('localFoto8')->move(base_path() . '\public\fotoPacientes' . $dataForm['nome'], $imageNameFoto8);
        } else {
            $imageNameFoto8 = $clienteEdit[0]->localFoto8;
        }

        $dataForm['ativo'] = (!isset($dataForm['ativo'])) ? 0 : 1;

        if ($dataForm['sexo'] = 'Masculino') {
            $dataForm['sexo'] = 1;
        } else {
            $dataForm['sexo'] = 0;
        }

        //dd($dataForm);

        $clienteEditado = DB::table('cliente')->where('Cod', $id)->update([
            'nome'             =>  $dataForm['nome'],
            'dtcad'            =>  $dataForm['dtcad'],
            'dtnasc'           =>  $dataForm['dtnasc'],
            'Responsavel'      =>  $dataForm['Responsavel'],
            'rua'              =>  $dataForm['rua'],
            'numero'           =>  $dataForm['numero'],
            'compl'            =>  $dataForm['compl'],
            'Bairro'           =>  $dataForm['Bairro'],
            'CEP'              =>  $dataForm['CEP'],
            'Cidade'           =>  $dataForm['Cidade'],
            'uf'               =>  $dataForm['uf'],
            'fone'             =>  $dataForm['fone'],
            'celular'          =>  $dataForm['celular'],
            'Obs'              =>  $dataForm['Obs'],
            'ativo'            =>  $dataForm['ativo'],
            'sexo'             =>  $dataForm['sexo'],
            'convenio'         =>  $dataForm['convenio'],
            'tipo'             =>  $dataForm['tipo'],
            'foto'             =>  $imageName,
            'profissao'        =>  $dataForm['profissao'],
            'dsEmail'          =>  $dataForm['dsEmail'],
            'dsCPF'            =>  $dataForm['dsCPF'],
            'dsCartaoConvenio' =>  $dataForm['dsCartaoConvenio']
        ]);

        //dd($dataForm);

        if ($clienteEditado) {

            $insertFoto = DB::table('fotos')->where('codcliente', $id)->update([
                'localFoto1' =>  $imageNameFoto1,
                'obsFoto1'   => (!isset($dataForm['obsFoto1'])) ? "-" : $dataForm['obsFoto1'],
                'localFoto2' =>  $imageNameFoto2,
                'obsFoto2'   => (!isset($dataForm['obsFoto2'])) ? "-" : $dataForm['obsFoto2'],
                'localFoto3' =>  $imageNameFoto3,
                'obsFoto3'   => (!isset($dataForm['obsFoto3'])) ? "-" : $dataForm['obsFoto3'],
                'localFoto4' =>  $imageNameFoto4,
                'obsFoto4'   => (!isset($dataForm['obsFoto4'])) ? "-" : $dataForm['obsFoto4'],
                'localFoto5' =>  $imageNameFoto5,
                'obsFoto5'   => (!isset($dataForm['obsFoto5'])) ? "-" : $dataForm['obsFoto5'],
                'localFoto6' =>  $imageNameFoto6,
                'obsFoto6'   => (!isset($dataForm['obsFoto6'])) ? "-" : $dataForm['obsFoto6'],
                'localFoto7' =>  $imageNameFoto7,
                'obsFoto7'   => (!isset($dataForm['obsFoto7'])) ? "-" : $dataForm['obsFoto7'],
                'localFoto8' =>  $imageNameFoto8,
                'obsFoto8'   => (!isset($dataForm['obsFoto8'])) ? "-" : $dataForm['obsFoto8'],
            ]);
            //dd($insertFoto);
            if ($insertFoto)
                return redirect()->route('cliente.index');
        } else {
            return redirect()->route('cliente.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clienteDestroy = DB::table('cliente')->where('Cod', $id)->delete();

        $fotoDestroy =  DB::table('fotos')->where('codcliente', $id)->delete();

        if ($clienteDestroy)
            return redirect()->route('cliente.index');
        else
            return redirect()->route('cliente.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($id)
    {
        $clientePDF = DB::table('cliente')->select(
            'cliente.*',
            DB::raw('DATE_FORMAT(cliente.dtcad,"%d-%m-%Y") as dtcad'),
            DB::raw('DATE_FORMAT(cliente.dtnasc,"%d-%m-%Y") as dtnasc')
        )->where('Cod', $id)->get();

        //dd($clientePDF);

        $data = ['title' => 'Dados do Cliente'];
        $pdf = PDF::loadView('cadastros.cliente.myPDF', $data, compact('clientePDF'));

        return $pdf->stream('cliente.pdf');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function agendaProxConsulta(Request $request)
    {
        $dataForm = $request->all();

        //dd($dataForm);

        $cliente = DB::table('cliente')
            ->join('convenio', 'cliente.convenio', '=', 'convenio.Cod')
            ->select('cliente.*', 'convenio.nome as nomeConvenio')->where('cliente.Cod', $dataForm['codcli'])->get();

        //dd($cliente[0]->nomeConvenio);

        $insert = DB::table('agenda')->insert([
            'codcli'         =>  $dataForm['codcli'],
            'data'           =>  $dataForm['data'],
            'horario'        =>  $dataForm['horario'],
            'realizado'      =>  'N',
            'tipo'           =>  $dataForm['tipo'],
            'nomePaciente'   =>  $cliente[0]->nome,
            'nomeConvenio'   =>  $cliente[0]->nomeConvenio,
            'fonePaciente'   =>  $cliente[0]->fone,
            'cdProfissional' =>  $dataForm['cdProfissional']
        ]);
        if ($insert) {
            return redirect()->route('agenda.index');
        } else {
            return redirect()->back();
        }
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

        //dd($dataForm);

        $title = 'Listagem de Clientes';

        //$clientes = $this->cliente->paginate($this->totalPage);

        $clientes = Cliente::select(
            'cliente.*',
            DB::raw('DATE_FORMAT(dtcad,"%d-%m-%Y") as dtcad'),
            DB::raw('DATE_FORMAT(dtnasc,"%d-%m-%Y") as dtnasc')
        )->where('nome', 'like', '%' . $dataForm['texto'] . '%')
            ->paginate($this->totalPage);

        //dd($clientes);

        return view('cadastros.cliente.index', compact('clientes', 'title'));
    }
}
