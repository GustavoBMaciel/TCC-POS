<?php

namespace App\Http\Controllers\Cadastros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cadastros\Tbexames;
use App\Models\Cadastros\Cliente;
use App\Models\Cadastros\Tbprofissional;
use App\Models\Cadastros\Exame;
use App\Http\Requests\Cadastros\ExamesItensFormRequest;
use App\Models\Cadastros\Tbexamesitens;
use App\Http\Controllers\Auth;
use DB;
use PDF;

class TbexamesController extends Controller
{
    private $tbexames;
    private $totalPage = 5;

    public function __construct(Tbexames $tbexames)
    {
        $this->middleware('auth');

        $this->tbexames = $tbexames;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Listagem de Exames';

        $clientes = Cliente::select('nome', 'Cod')->get();

        $profissoes = Tbprofissional::select('dsNomeMedico', 'cdProfissional')->get();

        $tbexames = $this->tbexames->paginate($this->totalPage);
        return view('cadastros.tbexame.create-edit', compact('tbexames', 'title', 'clientes', 'profissoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastrar Novo Exame';

        $clientes = Cliente::select('nome', 'Cod')->get();

        $profissoes = Tbprofissional::select('dsNomeMedico', 'cdProfissional')->get();

        $exames = DB::table('tbexames')
            ->join('cliente', 'tbexames.codCliente', '=', 'cliente.Cod')
            ->join('tbprofissional', 'tbexames.cdProfissional', '=', 'tbprofissional.cdProfissional')
            ->select(
                'tbexames.*',
                DB::raw('DATE_FORMAT(tbexames.data,"%d-%m-%Y") as data'),
                'cliente.nome as nome',
                'tbprofissional.dsNomeMedico as medico'
            )->get();

        $tbexames = $this->tbexames->paginate($this->totalPage);

        return view('cadastros.tbexame.create-edit', compact('title', 'tbexames', 'clientes', 'profissoes', 'exames'));
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

        $insert = $this->tbexames->create([
            'codCliente'     =>  $dataForm['codCliente'],
            'cdProfissional' =>  $dataForm['cdProfissional'],
            'data'           =>  date('Y-m-d'),
            'obs'            =>  "",
            'usuario'        =>   $loggedUser->name
        ]);

        if ($insert) {
            $idProfissao = Tbexames::select('cdExames')->max('cdExames');
            return redirect()->route('tbexames.show', $idProfissao);
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
        $tbexamesShow = DB::table('tbexames')
            ->join('cliente', 'tbexames.codCliente', '=', 'cliente.Cod')
            ->join('tbprofissional', 'tbexames.cdProfissional', '=', 'tbprofissional.cdProfissional')
            ->select('tbexames.*', DB::raw('DATE_FORMAT(tbexames.data,"%d-%m-%Y") as data'), 'cliente.nome as nome', 'tbprofissional.dsNomeMedico as medico')
            ->where('cdExames', $id)->get();

        $exames = Exame::select('exames.*')->get();

        $examesItens = DB::table('tbexamesitens')
            ->join('tbexames', 'tbexamesitens.codExames', '=', 'tbexames.cdExames')
            ->join('exames', 'tbexamesitens.codExame', '=', 'exames.Codigo')
            ->select('tbexamesitens.*', 'exames.*', 'tbexames.*', DB::raw('DATE_FORMAT(tbexames.data,"%d-%m-%Y") as data'))
            ->where('codExames', $id)->get();

        $title = "Visualizando Exame: {$tbexamesShow[0]->cdExames}";

        return view('cadastros.tbexame.show', compact('title', 'tbexamesShow', 'exames', 'examesItens'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tbexamesEdit = DB::table('tbexames')->where('cdExames', $id)->get();

        $clientes = Cliente::select('nome', 'Cod')->get();

        $profissoes = Tbprofissional::select('dsNomeMedico', 'cdProfissional')->get();

        $tbexames = $this->tbexames->paginate($this->totalPage);

        $title = "Editar Exame: {$tbexamesEdit[0]->cdExames}";

        return view('cadastros.tbexame.create-edit', compact('title', 'tbexamesEdit', 'tbexames', 'clientes', 'profissoes'));
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

        $tbexamesEditado = DB::table('tbexames')->where('cdExames', $id)->update($dataForm);

        if ($tbexamesEditado)
            return redirect()->route('tbexame.index');
        else
            return redirect()->route('tbexame.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tbexamesDestroy = DB::table('tbexames')->where('cdExames', $id)->delete();

        if ($tbexamesDestroy)
            return redirect()->route('tbexame.index');
        else
            return redirect()->route('tbexame.show', $id)->with(['errors' => 'Falha ao deletar']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function examesItens(ExamesItensFormRequest $request)
    {
        $dataForm = $request->all();

        //dd($dataForm);

        $insert = DB::table('tbexamesitens')->insert([
            'codExames' =>  $dataForm['codExames'],
            'codExame'   =>  $dataForm['codExame']
        ]);
        if ($insert) {
            $update = DB::table('tbexames')->where('cdExames', $dataForm['codExames'])->update([
                'obs' =>  $dataForm['obs']
            ]);
        }

        $examesItens = DB::table('tbexamesitens')
        ->join('exames', 'tbexamesitens.codExame', '=', 'exames.Codigo')
        ->select('tbexamesitens.*', 'exames.nome as nome')
        ->where('codExames', $dataForm['codExames'])->get();

        $tbexamesShow = DB::table('tbexames')
        ->join('cliente', 'tbexames.codCliente', '=', 'cliente.Cod')
        ->join('tbprofissional', 'tbexames.cdProfissional', '=', 'tbprofissional.cdProfissional')
        ->select('tbexames.*', DB::raw('DATE_FORMAT(tbexames.data,"%d-%m-%Y") as data'), 'cliente.nome as nome', 'tbprofissional.dsNomeMedico as medico')
        ->where('cdExames', $dataForm['codExames'])->get();

        $exames = Exame::select('exames.*')->get();

        //dd($examesItens);

        if ($update) {

            return view('cadastros.tbexame.show', compact('examesItens', 'tbexamesShow', 'exames'));
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
        $tbexamesPDF = DB::table('tbexames')
        ->join('cliente', 'tbexames.codCliente', '=', 'cliente.Cod')
        ->join('tbprofissional', 'tbexames.cdProfissional', '=', 'tbprofissional.cdProfissional')
        ->join('tbexamesitens', 'tbexames.cdExames', '=', 'tbexamesitens.codExames')
        ->join('exames', 'tbexamesitens.codExame', '=', 'exames.Codigo')
        ->select('tbexames.*', DB::raw('DATE_FORMAT(tbexames.data,"%d-%m-%Y") as data'), 'cliente.nome as nomecli', 'tbprofissional.dsNomeMedico as medico', 'exames.*')
        ->where('cdExames', $id)->get();

        $examesItens = DB::table('tbexamesitens')
        ->join('exames', 'tbexamesitens.codExame', '=', 'exames.Codigo')
        ->select('tbexamesitens.*', 'exames.nome as nome')
        ->where('codExames', $id)->get();

        //dd($tbexamesPDF);

        $data = ['title' => 'Dados do Cliente'];
        $pdf = PDF::loadView('cadastros.tbexame.myPDF', $data, compact('tbexamesPDF', 'examesItens'));

        return $pdf->stream('exames.pdf');
    }
}
