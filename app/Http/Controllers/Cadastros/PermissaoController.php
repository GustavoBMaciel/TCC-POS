<?php

namespace App\Http\Controllers\Cadastros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cadastros\Permissao;
use App\Http\Controllers\Auth;
use DB;


class PermissaoController extends Controller
{
    private $permissao;
    private $totalPage = 20;

    public function __construct(Permissao $permissao)
    {
        $this->middleware('auth');

        $this->permissao = $permissao;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Listagem de Permissões';

        $permissaoShow = "";

        $permissaoCli = [];

        $codcli = [];

        $usuarios = DB::table('acesso')->select('codigo', 'Usuario')->get();

        $permissaosG = $this->permissao->get();

        //dd($permissaosG);

        return view('cadastros.permissao.index', compact('usuarios', 'title', 'permissaoShow', 'permissaosG', 'permissaoCli', 'codcli'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Codigo para gerar as permissões
        /*select 
        concat('DB::table(\'permissao\')->insert(
            [\'descricaobusca\' => \'', ifNull( descricaobusca, '') , '\', 
            \'descricaotela\' => \'' , ifNull( descricaotela, '') , '\',
            \'grupo\' => \'' , ifNull( grupo, '') , '\',
            \'cdgrupopermissao\' => \'' , ifNull( cdgrupopermissao, 0) , '\'
            ]
        );')
        INTO OUTFILE 'E:\\teste2.txt'
        from permissao*/

        DB::table('permissao')->truncate();

        DB::table('permissao')->insert(
            [
                'descricaobusca' => 'Cadastrar Convenio',
                'descricaotela' => 'Cadastro de Convênios',
                'grupo' => 'CADASTROS',
                'cdgrupopermissao' => '1'
            ]
        );
        DB::table('permissao')->insert(
            [
                'descricaobusca' => 'Cadastrar Fornecedores',
                'descricaotela' => 'Cadastro de Fornecedores',
                'grupo' => 'CADASTROS',
                'cdgrupopermissao' => '1'
            ]
        );
        DB::table('permissao')->insert(
            [
                'descricaobusca' => 'Cadastrar Exames',
                'descricaotela' => 'Cadastro de Exames',
                'grupo' => 'CADASTROS',
                'cdgrupopermissao' => '1'
            ]
        );
        DB::table('permissao')->insert(
            [
                'descricaobusca' => 'Cadastrar Medicamentos',
                'descricaotela' => 'Cadastro de Medicamentos',
                'grupo' => 'CADASTROS',
                'cdgrupopermissao' => '1'
            ]
        );
        DB::table('permissao')->insert(
            [
                'descricaobusca' => 'Cadastrar Status de Agenda',
                'descricaotela' => 'Cadastro de Status de Agenda',
                'grupo' => 'CADASTROS',
                'cdgrupopermissao' => '1'
            ]
        );
        DB::table('permissao')->insert(
            [
                'descricaobusca' => 'Cadastrar Tipos de Agendamento',
                'descricaotela' => 'Cadastro de Tipos de Agendamento',
                'grupo' => 'CADASTROS',
                'cdgrupopermissao' => '1'
            ]
        );
        DB::table('permissao')->insert(
            [
                'descricaobusca' => 'Cadastrar Profissoes',
                'descricaotela' => 'Cadastro de Profissoes',
                'grupo' => 'CADASTROS',
                'cdgrupopermissao' => '1'
            ]
        );
        DB::table('permissao')->insert(
            [
                'descricaobusca' => 'Cadastrar Anamneses',
                'descricaotela' => 'Cadastro de Anamneses',
                'grupo' => 'ANAMNESE',
                'cdgrupopermissao' => '2'
            ]
        );
        DB::table('permissao')->insert(
            [
                'descricaobusca' => 'Agendamento',
                'descricaotela' => 'Criar Agendamento',
                'grupo' => 'AGENDA',
                'cdgrupopermissao' => '3'
            ]
        );
        DB::table('permissao')->insert(
            [
                'descricaobusca' => 'Altera Agenda',
                'descricaotela' => 'Alterar Agendamento',
                'grupo' => 'AGENDA',
                'cdgrupopermissao' => '3'
            ]
        );
        DB::table('permissao')->insert(
            [
                'descricaobusca' => 'Exclui Agenda',
                'descricaotela' => 'Excluir Agendamento',
                'grupo' => 'AGENDA',
                'cdgrupopermissao' => '3'
            ]
        );
        DB::table('permissao')->insert(
            [
                'descricaobusca' => 'Proxima Consulta',
                'descricaotela' => 'Gerencia Próxima Consulta',
                'grupo' => 'AGENDA',
                'cdgrupopermissao' => '3'
            ]
        );
        DB::table('permissao')->insert(
            [
                'descricaobusca' => 'Consulta Pacientes Atendidos',
                'descricaotela' => 'Consultar Pacientes',
                'grupo' => 'CONSULTAS',
                'cdgrupopermissao' => '4'
            ]
        );
        DB::table('permissao')->insert(
            [
                'descricaobusca' => 'Caixa',
                'descricaotela' => 'Controle de Caixa Diário',
                'grupo' => 'FINANCEIRO',
                'cdgrupopermissao' => '5'
            ]
        );
        DB::table('permissao')->insert(
            [
                'descricaobusca' => 'Receber',
                'descricaotela' => 'Controle de Contas a Receber',
                'grupo' => 'FINANCEIRO',
                'cdgrupopermissao' => '5'
            ]
        );
        DB::table('permissao')->insert(
            [
                'descricaobusca' => 'Pagar',
                'descricaotela' => 'Controle de Contas a Pagar',
                'grupo' => 'FINANCEIRO',
                'cdgrupopermissao' => '5'
            ]
        );
        DB::table('permissao')->insert(
            [
                'descricaobusca' => 'Recibo',
                'descricaotela' => 'Emissão de Recibo de Pagamento',
                'grupo' => 'FINANCEIRO',
                'cdgrupopermissao' => '5'
            ]
        );
        DB::table('permissao')->insert(
            [
                'descricaobusca' => 'Atestado',
                'descricaotela' => 'Emissão de Atestados',
                'grupo' => 'IMPRESSOS',
                'cdgrupopermissao' => '6'
            ]
        );
        DB::table('permissao')->insert(
            [
                'descricaobusca' => 'Declaracao',
                'descricaotela' => 'Emissão de Declaração',
                'grupo' => 'IMPRESSOS',
                'cdgrupopermissao' => '6'
            ]
        );
        DB::table('permissao')->insert(
            [
                'descricaobusca' => 'Exames',
                'descricaotela' => 'Emissão de Exames',
                'grupo' => 'IMPRESSOS',
                'cdgrupopermissao' => '6'
            ]
        );
        DB::table('permissao')->insert(
            [
                'descricaobusca' => 'Receituario',
                'descricaotela' => 'Emissão de Receituário',
                'grupo' => 'IMPRESSOS',
                'cdgrupopermissao' => '6'
            ]
        );
        DB::table('permissao')->insert(
            [
                'descricaobusca' => 'Permissao Usuario',
                'descricaotela' => 'Permissão de Usuários',
                'grupo' => 'UTILITARIOS',
                'cdgrupopermissao' => '7'
            ]
        );

        return redirect()->route('permissao.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataForm = $request->except(['_token']);

        $arrayLength = count($dataForm['permissões'], COUNT_RECURSIVE);

        $delete = DB::table('permissaofuncio')->where('codfun', $dataForm['codfun'])->delete();
        
        for ($i = 0; $i < $arrayLength; $i++) {
           
            $insert = DB::table('permissaofuncio')->insert([
                'codfun'          =>  $dataForm['codfun'],
                'codigopermissao' =>  $dataForm['permissões'][$i]
            ]);
        }

        if ($insert) {
            return redirect()->route('permissao.index');
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
        $title = 'Listagem de Permissões';

        $permissaoShow = "";

        $codcli = [];

        $permissaoCli = DB::table('permissaofuncio')->select('codigopermissao')->where('codfun', $id)->pluck('codigopermissao');

        $usuarios = DB::table('acesso')->select('codigo', 'Usuario')->get();

        $permissaosG = $this->permissao->get();

        //dd($permissaosG);

        return view('cadastros.permissao.show', compact('usuarios', 'title', 'permissaoShow', 'permissaosG', 'permissaoCli', 'codcli'));
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
        //
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function consulta(Request $request)
    {
        $dataForm = $request->except(['_token']);

        //dd($dataForm);

        $title = 'Listagem de Permissões';

        $permissaoShow = "";

        $codcli = [];

        $usuarios = DB::table('acesso')->select('codigo', 'Usuario')->get();

        $permissaosG = $this->permissao->get();

        $permissaoCli = DB::table('permissaofuncio')->select('codigopermissao', 'codfun')->where('codfun', $dataForm['codfun'])->distinct()->get();

        $nomeCli = DB::table('acesso')->select('codigo', 'Usuario')->where('codigo', $dataForm['codfun'])->first();

        //dd($permissaoCli);

        return view('cadastros.permissao.show', compact('usuarios', 'title', 'permissaoShow', 'permissaosG', 'permissaoCli', 'codcli', 'nomeCli'));
    }

}
