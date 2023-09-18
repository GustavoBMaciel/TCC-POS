<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agendas = DB::table('agenda')
        ->join('tbstatusagenda', 'agenda.realizado', '=', 'tbstatusagenda.dsSimbolo')
        ->join('tbtipoagendamento', 'agenda.tipo', '=', 'tbtipoagendamento.cdTipoAgendamento')
        ->join('tbprofissional', 'agenda.cdProfissional', '=', 'tbprofissional.cdProfissional')
        ->select('agenda.*', DB::raw('DATE_FORMAT(data,"%d-%m-%Y") as data'), 'tbstatusagenda.*', 'tbtipoagendamento.nome as tipoNome', 'tbprofissional.*')
        ->where('data', date('Y-m-d'))->get();
        
        return view('home', compact('agendas'));
    }
}
