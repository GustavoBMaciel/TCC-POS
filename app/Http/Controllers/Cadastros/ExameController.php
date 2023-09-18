<?php

namespace App\Http\Controllers\Cadastros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cadastros\Exame;
use App\Http\Requests\Cadastros\ExameFormRequest;
use App\Http\Controllers\Auth;
use DB;

class ExameController extends Controller
{
    private $exame;
    private $totalPage = 5;

    public function __construct(Exame $exame)
    {
        $this->middleware('auth');

        $this->exame = $exame;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Codigo para gerar os exames
        /*select 
        concat('DB::table(\'exames\')->insert(
            [\'nome\' => \'', ifNull( nome, '') , '\',
            ]
        );')
        INTO OUTFILE 'E:\\teste3.txt'*/

        DB::table('exames')->truncate();

        DB::table('exames')->insert(
            [
                'nome' => 'HEMOGRAMA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'URÉIA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'CREATININA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'GLICEMIA DE JEJUM',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'LIPIDOGRAMA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'TSH',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'TGO',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'TGP',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'GAMA GT',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'PSA TOTAL E LIVRE',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'TESTOSTERONA TOTAL E LIVRE',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'EAS',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'BILIRRUBINAS TOTAL E FRAÇOES',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'VHS',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'PCR',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'UROCULTURA COM ANTIBIOGRAMA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ULTRA SOM DAS VIAS URINÁRIAS',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'RX SIMPLES DE ABDOME COM PREPARO ',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'PSA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'PROLACTINA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'UROGRAFIA EXCRETORA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'RX LOCALIZADO DA PEQUENA BACIA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ULTRA SOM DA PROSTATA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ÁCIDO ÚRICO',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ULTRA SOM PENIANO COM DOPPLER',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'VDRL',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'FTA-ABS',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'PESQUISA HIV',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ANTI HCV',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'HBS-AG',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'FOSFATASE ALCALINA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'CEA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'GLICEMIA PÓS PRANDIAL',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'PESQUISA DE SANGUE OCULTO NAS FEZES',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'MIF EM 3 AMOSTRAS',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ULTRA SOM ABDOMINAL TOTAL',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'CISTOCINTILOGRAFIA INDIRETA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'CPK',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'PROTEINÚRIA 24 HORAS.',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'CLEARANCE DE CREATININA.',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'FOSFATASE ÁCIDA PROSTÁTICA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'FOSFATASE ÁCIDA TOTAL',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'DESIDROGENASE LÁCTICA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'COAGULOGRAMA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'RISCO CIRURGICO',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ESPERMOGRAMA COMPLETO',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'CINTILOGRAFIA ÓSSEA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'RX DE TORAX EM PA E PERFIL',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ULTRA SOM PÉLVICO',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'RX LOCALIZADO DOS RINS',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ULTRA SOM DA BOLSA ESCROTAL COM DOPPLER',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'TC, MULTI SLICE, DAS VIAS URINÁRIAS.',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ÁCIDO ÚRICO',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'BILIRRUBINAS TOTAL E FRAÇÕES',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'USTR DA PROSTATA COM BIÓPSIA DIRIGIDA.',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'PCR ULTRA SENSÍVEL',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'URETROCISTOGRAFIA RETRÓGRADA.',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'LATEX',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'T4 LIVRE',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ECG',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'GRAM DE GOTA ( 1º JATO )',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'SWAB ENDOURETRAL',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'BACTERIOSCOPIA ( GRAM )',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'PESQUISA DE FUNGOS',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'PESQUISA DE CHLAMYDIA TRACOMATIS',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'PESQUISA DE FUNGOS',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'PESQUISA DE NEISSERIA GONORRAE',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'PESQUISA DE TRICOMONAS VAGINALIS',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'FSH',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'LH',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'DIMORFISMO ERITROCITÁRIO',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'TOMOGRAFIA, MULTI SLICE, ABDOMINAL TOTAL',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ESTUDO URODINÂMICO',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'HB GLICADA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ULTRA SOM PENIANO',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'TC, MULTISLICE, ABDOMINAL TOTAL',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'TC, MULTISLICE, PÉLVICA.',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'URETROCISTOGRAFIA MICCIONAL',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'CÁLCIO SÉRICO',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'CÁLCIÚRIA 24 HORAS.',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'DOSAGEM ÁCIDO ÚRICO 24 HORAS.',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'DEHIDROEPIANDROSTERONA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ALFA FETO PROTEINA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'CINTILOGRAFIA RENAL COM DMSA - estática',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'CINTILOGRAFIA RENAL COM DPTA - Dinâmica',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ULTRA SOM DA BOLSA ESCROTAL',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ESPERMOCULTURA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'U. S. RENAL COM DOPPLER DAS ART. RENAIS.',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'LIPASE',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'AMILASE',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'T3',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'T4',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'RX SIMPLES DE ABDOMEN',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'CISTOSCOPIA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'PARATORMONIO',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'B-HCG',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ECG COM DII LONGO',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ESTUDO IMUNOHISTOQUIMICO',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'UROFLUXOMETRIA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ULTRA SOM TRANSRETAL DA PROSTATA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ULTRA SOM TRANSVAGINAL',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'TRIGLICÉRIDES',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'RX SIMPLES DE ABDOME',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'FRUTOSE',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'MACHADO GUERREIRO',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'RX LOCALIZADO DA URETRA PENIANA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'POTÁSSIO',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ANÁTOMO PATOLÓGICO',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'RNM ABDOMINAL TOTAL',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'CITOLOGIA ONCÓTICA URINÁRIA.',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ANTI HBsAg',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'US TRANSRETAL ( PROSTATA E VESÍCULAS )',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'HBA1C',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'BETA HCG',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ANGIOTOMOGRAFIA DAS ARTÉRIAS RENAIS',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'RX DOS JOELHOS ( 2 INCISÕES )',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'RX DA COLUNA LOMBO-SACRA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'AVALIAÇÃO NUTRICIONISTA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'SOROLOGIA PARA DENGUE',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'TOMOGRAFIA DAS VIAS URINÁRIAS',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'DOSAGEM METANEFRINAS NA URINA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'DOSAGEM ÁCIDO VANILMANDÉLICO NA URINA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'PROGESTERONA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ALDOSTERONA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ESTRADIOL',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'HEPATITE A',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'FAN',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'VITAMINA D',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'VITAMINA B12',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'MICROALBUMINÚRIA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'IMUNOFIXAÇÃO 24 HS:PROTEÍNAS MONOCLONAIS',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => '25 - HIDROXIVITAMINA D',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ACIDO FOLICO',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ANÁLISE FÍSICO QUÍMICA DE CALCULO RENAL',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'RX SIMPLES DA URETRA PENIANA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'GLOBULINA LIGADORA DE HORMONIOS SEXUAIS ',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ESTRÓGENO',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'HIV',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'Análise Físico Química Cálculo Urinário',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'EPF',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'US:CANAL INGUINAL E TESTÍCULO C/ DOPPLER',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'DENSITOMETRIA ÓSSEA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'RX LOCALIZADO DO RIM DIREITO',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'MAGNESIO',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'PROTEINAS TOTAL E FRAÇÕES',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'COLONOSCOPIA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'TC PÉLVICA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'FISIOTERAPIA DO ASSOALHO PÉLVICO',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'RX DOS ARCOS COSTAIS ( 2 )',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'MAMOGRAFIA DIGITAL',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'RNM PÉLVICA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'FERRITINA SÉRICA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'US DOS MMII COM DOPPLER',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'HEPATITE C',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'TESTE ERGOMÉTRICO',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'CITRATO URINÁRIO',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'HEPATITE B',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'TOMOGRAFIA COMPUTADORIZADA DE TORAX',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'PLAQUETAS',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'SIFILES',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'TC, MULTISLICE, VIAS URINÁRIAS',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ANGIO TC DAS ARTÉRIAS RENAIS',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'AVALIAÇÃO PSICOLÓGICA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'BAAR NA URINA ( 3 AMOSTRAS )',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'PPD ( INTRADERMOREAÇÃO )',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'RECONSTRUÇÃO TRIDIMENSIONAL',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'URINA ROTINA ( 1º JATO )',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ULTRA SOM COM DOPPLER DAS CARÓTIDAS',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'AVALIAÇÃO CARDIOLÓGICA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'UROTOMOGRAFIA DAS VIAS URINÁRIAS',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'RNM DO ABDOME SUPERIOR',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'SÓDIO',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'Mg',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'FÓSFORO',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ALBUMINA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'GRUPO SANGUINEO',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'FATOR RH',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ULTRA TRANSRETAL DA PROSTATA E VESÍCULAS',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ULTRA SOM DA CAROTIDA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'GTT',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'RNI',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'TESTOSTERONA LIVRE',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ENDOSCOPIA DIGESTIVA ALTA',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'SELÊNIO',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'ANTI HgG - Igm',
            ]
        );
        DB::table('exames')->insert(
            [
                'nome' => 'COMPLEMENTO C4',
            ]
        );

        return redirect()->route('exame.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastrar Novo Exame';

        $exames = $this->exame->paginate($this->totalPage);

        return view('cadastros.exame.create-edit', compact('title', 'exames'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExameFormRequest $request)
    {
        //
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
    public function update(ExameFormRequest $request, $id)
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

    public function pesquisa(Request $request)
    {
        $dataForm = $request->all();

        //dd($dataForm);

        $title = 'Cadastrar Novo Exame';

        $pesquisa = 1;

        $exames = $this->exame
        ->where('nome', 'like', '%'.$dataForm['texto'].'%')
        ->paginate($this->totalPage);

        return view('cadastros.exame.create-edit', compact('title', 'exames'));
    }
}
