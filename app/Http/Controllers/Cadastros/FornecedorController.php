<?php

namespace App\Http\Controllers\Cadastros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cadastros\Fornecedor;
use App\Http\Requests\Cadastros\FornecedorFormRequest;
use App\Http\Controllers\Auth;
use DB;

class FornecedorController extends Controller
{
    private $fornecedor;
    private $totalPage = 5;
  
    public function __construct(Fornecedor $fornecedor)
    {
        $this->middleware('auth');
  
      $this->fornecedor = $fornecedor;
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
        $title = 'Cadastrar Novo Fornecedor';

        $fornecedores = Fornecedor::select('fornecedor.*',DB::raw('DATE_FORMAT(dtcad,"%d-%m-%Y") as dtcad'))->paginate($this->totalPage);

        return view('cadastros.fornecedor.create-edit',compact('title', 'fornecedores') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FornecedorFormRequest $request)
    {
        $dataForm = $request->all();
    
        $insert = $this->fornecedor->create($dataForm);
        if ($insert)
        {
          return redirect()->route('fornecedor.create');
        }
        else {
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
        $fornecedorEdit = Fornecedor::select('fornecedor.*',DB::raw('DATE_FORMAT(dtcad,"%Y-%m-%d") as dtcad'))->where('cod', $id)->get();

        $fornecedores = Fornecedor::select('fornecedor.*',DB::raw('DATE_FORMAT(dtcad,"%d-%m-%Y") as dtcad'))->paginate($this->totalPage);

        $title = "Editar Fornecedor: {$fornecedorEdit[0]->nome}";
    
        return view('cadastros.fornecedor.create-edit', compact('title', 'fornecedorEdit', 'fornecedores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FornecedorFormRequest $request, $id)
    {
        $dataForm = $request->except(['_token', '_method']);

        //dd($dataForm);

        $fornecedorEditado = DB::table('fornecedor')->where('cod', $id)->update($dataForm);
    
        if ( $fornecedorEditado )
        return redirect()->route('fornecedor.create');
        else
        return redirect()->route('fornecedor.create');
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fornecedorDestroy = DB::table('fornecedor')->where('cod', $id)->delete();

        if ( $fornecedorDestroy )
        return redirect()->route('fornecedor.create');
        else
        return redirect()->route('fornecedor.create');
    
    }

    public function pesquisa(Request $request)
    {
        $dataForm = $request->all();

        //dd($dataForm);

        $pesquisa = 1;

        $title = 'Cadastrar Novo Fornecedor';

        $fornecedores = Fornecedor::select('fornecedor.*',DB::raw('DATE_FORMAT(dtcad,"%d-%m-%Y") as dtcad'))
        ->where('nome', $dataForm['texto'])
        ->paginate($this->totalPage);

        return view('cadastros.fornecedor.create-edit',compact('title', 'fornecedores', 'pesquisa') );
    }
}
