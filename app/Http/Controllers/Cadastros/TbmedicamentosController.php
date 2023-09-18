<?php

namespace App\Http\Controllers\Cadastros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cadastros\Tbmedicamentos;
use App\Models\Cadastros\Cliente;
use App\Models\Cadastros\Tbprofissional;
use App\Models\Cadastros\Medicamento;
use App\Models\Cadastros\Tbmedicamentositens;
use App\Http\Requests\Cadastros\MedicamentosItensFormRequest;
use App\Http\Controllers\Auth;
use DB;
use PDF;

class TbmedicamentosController extends Controller
{
    private $tbmedicamentos;
    private $totalPage = 5;

    public function __construct(Tbmedicamentos $tbmedicamentos)
    {
        $this->middleware('auth');

        $this->tbmedicamentos = $tbmedicamentos;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Listagem de Medicamentos';

        $clientes = Cliente::select('nome', 'Cod')->get();

        $profissoes = Tbprofissional::select('dsNomeMedico', 'cdProfissional')->get();

        $tbmedicamentos = $this->tbmedicamentos->paginate($this->totalPage);
        return view('cadastros.tbmedicamento.create-edit', compact('tbmedicamentos', 'title', 'clientes', 'profissoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastrar Novo Medicamento';

        $clientes = Cliente::select('nome', 'Cod')->get();

        $profissoes = Tbprofissional::select('dsNomeMedico', 'cdProfissional')->get();

        $medicamentos = DB::table('tbmedicamentos')
            ->join('cliente', 'tbmedicamentos.codCliente', '=', 'cliente.Cod')
            ->join('tbprofissional', 'tbmedicamentos.cdProfissional', '=', 'tbprofissional.cdProfissional')
            ->select(
                'tbmedicamentos.*',
                DB::raw('DATE_FORMAT(tbmedicamentos.data,"%d-%m-%Y") as data'),
                'cliente.nome as nome',
                'tbprofissional.dsNomeMedico as medico'
            )->get();

        $tbmedicamentos = $this->tbmedicamentos->paginate($this->totalPage);

        return view('cadastros.tbmedicamento.create-edit', compact('title', 'tbmedicamentos', 'clientes', 'profissoes', 'medicamentos'));
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

        //dd($dataForm);

        $loggedUser = \Auth::user();

        $insert = $this->tbmedicamentos->create([
            'codCliente'     =>  $dataForm['codCliente'],
            'cdProfissional' =>  $dataForm['cdProfissional'],
            'data'           =>  date('Y-m-d'),
            'obs'            =>  "",
            'usuario'        =>   $loggedUser->name
        ]);

        if ($insert) {
            $idProfissao = Tbmedicamentos::select('cdMedicamentos')->max('cdMedicamentos');
            return redirect()->route('tbmedicamentos.show', $idProfissao);
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
        $tbmedicamentosShow = DB::table('tbmedicamentos')
            ->join('cliente', 'tbmedicamentos.codCliente', '=', 'cliente.Cod')
            ->join('tbprofissional', 'tbmedicamentos.cdProfissional', '=', 'tbprofissional.cdProfissional')
            ->select('tbmedicamentos.*', DB::raw('DATE_FORMAT(tbmedicamentos.data,"%d-%m-%Y") as data'), 'cliente.nome as nome', 'tbprofissional.dsNomeMedico as medico')
            ->where('cdMedicamentos', $id)->get();

        $medicamentos = Medicamento::select('medicamento.*')->get();

        $medicamentosItens = DB::table('tbmedicamentositens')
            ->join('medicamento', 'tbmedicamentositens.codMedicamento', '=', 'medicamento.codigo')
            ->select('tbmedicamentositens.*', 'medicamento.*')
            ->where('codMedicamentos', $id)->get();

        $title = "Visualizando Exame: {$tbmedicamentosShow[0]->cdMedicamentos}";

        return view('cadastros.tbmedicamento.show', compact('title', 'tbmedicamentosShow', 'medicamentos', 'medicamentosItens'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tbmedicamentosEdit = DB::table('tbmedicamentos')->where('cdMedicamentos', $id)->get();

        $clientes = Cliente::select('nome', 'Cod')->get();

        $profissoes = Tbprofissional::select('dsNomeMedico', 'cdProfissional')->get();

        $tbmedicamentos = $this->tbmedicamentos->paginate($this->totalPage);

        $title = "Editar Medicamentos: {$tbmedicamentosEdit[0]->cdMedicamentos}";

        return view('cadastros.tbmedicamento.create-edit', compact('title', 'tbmedicamentosEdit', 'tbmedicamentos', 'clientes', 'profissoes'));
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

        $tbmedicamentosEditado = DB::table('tbmedicamentos')->where('cdMedicamentos', $id)->update($dataForm);

        if ($tbmedicamentosEditado)
            return redirect()->route('tbmedicamento.index');
        else
            return redirect()->route('tbmedicamento.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tbmedicamentosDestroy = DB::table('tbmedicamentos')->where('cdMedicamentos', $id)->delete();

        if ($tbmedicamentosDestroy)
            return redirect()->route('tbmedicamento.index');
        else
            return redirect()->route('tbmedicamento.show', $id)->with(['errors' => 'Falha ao deletar']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function medicamentosItens(MedicamentosItensFormRequest $request)
    {
        $dataForm = $request->all();

        $medicamentoIt = Medicamento::select('medicamento.*')->where('codigo', $dataForm['codMedicamento'])->get();

        //dd($dataForm);

        $insert = DB::table('tbmedicamentositens')->insert([
            'codMedicamentos' =>  $dataForm['codMedicamentos'],
            'codMedicamento'  =>  $dataForm['codMedicamento'],
            'concentracao'    =>  $medicamentoIt[0]->concentracao,
            'administracao'   =>  $medicamentoIt[0]->administracao,
            'posologia'       =>  $medicamentoIt[0]->posologia,
            'qtde'            =>  $dataForm['qtde'],
        ]);
        if ($insert) {
            $update = DB::table('tbmedicamentos')->where('cdMedicamentos', $dataForm['codMedicamentos'])->update([
                'obs' =>  $dataForm['obs']
            ]);
        }

        $tbmedicamentosShow = DB::table('tbmedicamentos')
            ->join('cliente', 'tbmedicamentos.codCliente', '=', 'cliente.Cod')
            ->join('tbprofissional', 'tbmedicamentos.cdProfissional', '=', 'tbprofissional.cdProfissional')
            ->select('tbmedicamentos.*', DB::raw('DATE_FORMAT(tbmedicamentos.data,"%d-%m-%Y") as data'), 'cliente.nome as nome', 'tbprofissional.dsNomeMedico as medico')
            ->where('cdMedicamentos', $dataForm['codMedicamentos'])->get();

        $medicamentos = Medicamento::select('medicamento.*')->get();

        $medicamentosItens = DB::table('tbmedicamentositens')
            ->join('medicamento', 'tbmedicamentositens.codMedicamento', '=', 'medicamento.codigo')
            ->select('tbmedicamentositens.*', 'medicamento.*')
            ->where('codMedicamentos', $dataForm['codMedicamentos'])->get();

        //dd($examesItens);

        if ($update) {

            return view('cadastros.tbmedicamento.show', compact('medicamentosItens', 'tbmedicamentosShow', 'medicamentos'));
            //return redirect()->route('tbexames.show',  $dataForm['codExames'])->compact('examesItens');
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
    public function generatePDF($id)
    {
        $tbmedicamentosPDF = DB::table('tbmedicamentos')
            ->join('cliente', 'tbmedicamentos.codCliente', '=', 'cliente.Cod')
            ->join('tbprofissional', 'tbmedicamentos.cdProfissional', '=', 'tbprofissional.cdProfissional')
            ->join('tbmedicamentositens', 'tbmedicamentos.cdMedicamentos', '=', 'tbmedicamentositens.codMedicamentos')
            ->join('medicamento', 'tbmedicamentositens.codMedicamento', '=', 'medicamento.codigo')
            ->select('tbmedicamentos.*', DB::raw('DATE_FORMAT(tbmedicamentos.data,"%d-%m-%Y") as data'), 'cliente.nome as nomecli', 'tbprofissional.dsNomeMedico as medico', 'medicamento.*')
            ->where('cdMedicamentos', $id)->get();

            //dd($tbmedicamentosPDF);

        $medicamentosItens = DB::table('tbmedicamentositens')
            ->join('medicamento', 'tbmedicamentositens.codMedicamento', '=', 'medicamento.codigo')
            ->select('tbmedicamentositens.*', 'medicamento.*')
            ->where('codMedicamentos', $id)->get();

        //dd($medicamentosItens);

        $data = ['title' => 'Dados do Cliente'];
        $pdf = PDF::loadView('cadastros.tbmedicamento.myPDF', $data, compact('tbmedicamentosPDF', 'medicamentosItens'));

        return $pdf->stream('medicamentos.pdf');
    }
}
