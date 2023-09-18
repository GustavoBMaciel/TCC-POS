<?php

namespace App\Http\Controllers\Cadastros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cadastros\Tbprofissional;
use App\Http\Requests\Cadastros\ProfissionalFormRequest;
use App\Http\Controllers\Auth;
use DB;

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

class ProfissionalController extends Controller
{
    private $tbprofissional;
    private $totalPage = 20;

    public function __construct(Tbprofissional $tbprofissional)
    {
        $this->middleware('auth');

        $this->tbprofissional = $tbprofissional;
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
        $title = 'Cadastrar Novo Profissional';

        $tbprofissionals = $this->tbprofissional->paginate($this->totalPage);

        return view('cadastros.profissional.create-edit', compact('title', 'tbprofissionals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfissionalFormRequest $request)
    {
        $dataForm = $request->all();

        $insert = $this->tbprofissional->create($dataForm);
        if ($insert) {
            return redirect()->route('profissional.create');
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
        $tbprofissionalEdit = DB::table('tbprofissional')->where('cdProfissional', $id)->get();

        $tbprofissionals = $this->tbprofissional->paginate($this->totalPage);

        $title = "Editar Profissional: {$tbprofissionalEdit[0]->dsNomeMedico}";

        return view('cadastros.profissional.create-edit', compact('title', 'tbprofissionalEdit', 'tbprofissionals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfissionalFormRequest $request, $id)
    {
        $dataForm = $request->except(['_token', '_method']);

        $tbprofissionalEditado = DB::table('tbprofissional')->where('cdProfissional', $id)->update($dataForm);

        if ($tbprofissionalEditado)
            return redirect()->route('profissional.create');
        else
            return redirect()->route('profissional.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tbprofissionalDestroy = DB::table('tbprofissional')->where('cdProfissional', $id)->delete();

        if ($tbprofissionalDestroy)
            return redirect()->route('profissional.create');
        else
            return redirect()->route('profissional.create');
    }

    public function pesquisa(Request $request)
    {
        $dataForm = $request->all();

        //dd($dataForm);

        $pesquisa = 1;

        $title = 'Cadastrar Novo Profissional';

        $tbprofissionals = $this->tbprofissional->where('dsNomeMedico', 'like', '%'.$dataForm['texto'].'%')->paginate($this->totalPage);

        return view('cadastros.profissional.create-edit', compact('title', 'tbprofissionals', 'pesquisa'));
    }
}
