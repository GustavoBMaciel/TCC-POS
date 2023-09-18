@extends('layouts.appHome')

@section('content')
<div class="container">

  <div class="panel-heading">{{$tbstatusagendaEdit->nome or 'Novo'}}</div>


  @if( isset ($errors) && count ($errors) > 0 )
  <div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Restrições!</h4>
    @foreach( $errors->all() as $error )
    <p>{{$error}} </p>
    @endforeach
  </div>
  @endif

  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a @if(isset ($pesquisa)) class="nav-item nav-link" @else class="nav-item nav-link active" @endif id="nav-dadosPessoais-tab" data-toggle="tab" href="#nav-dadosPessoais" role="tab" aria-controls="nav-dadosPessoais" aria-selected="true">Tipo de Agendamento</a>
      <a @if(isset ($pesquisa)) class="nav-item nav-link active" @else class="nav-item nav-link" @endif id="nav-dadosAnamnese-tab" data-toggle="tab" href="#nav-dadosAnamnese" role="tab" aria-controls="nav-dadosAnamnese" aria-selected="false">Consultar</a>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div @if(isset ($pesquisa)) class="tab-pane" @else class="tab-pane active" @endif  id="nav-dadosPessoais" role="tabpanel" aria-labelledby="nav-dadosPessoais-tab">

      @if(isset ($tbstatusagendaEdit))
      @foreach ($tbstatusagendaEdit as $tbstatusagendaEdits)
      @endforeach
      {!! Form::model($tbstatusagendaEdits, ['route' => ['tbstatusagenda.update', $tbstatusagendaEdits->codigo ], 'enctype' => 'multipart/form-data', 'class' => 'form', 'method' => 'put']) !!}
      @else
      {!! Form::open(['route' => 'tbstatusagenda.store', 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}
      @endif

      <div class="form-row align-items-center">
        <div class="form-group col-sm-6 my-1">
          <label>Nome: </label>
          {!! Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'EX: Agendado']) !!}
        </div>
        <div class="form-group col-sm-3 my-1">
          <label>Símbolo: </label>
          {!! Form::text('dsSimbolo', null, ['class' => 'form-control', 'placeholder' => 'EX: A']) !!}
        </div>
        <div class="form-group col-sm-2 my-1">
          <label>Valor da Cor: </label>
          <input type="text" id="dsCor" name="dsCor" value="#0000ff" class="form-control" placeholder="EX: #0000ff">
        </div>
        <div class="form-group col-sm-1 my-1">
          <label>Cores: </label>
          <input type="color" value="#0000ff" class="form-control" id="colorWell">
        </div>
      </div>
      <div class="form-row align-items-center">
        <div class="form-group col-sm-6">
          <button type="submit" style="text-align: center;" class="btn btn-primary col-sm-12"><i class="far fa-save" style="font-size:20px;"></i> Salvar</button>
        </div>

        <div class="form-group col-sm-6">
          <a href="{{route('cliente.index')}}" style="text-align: center;" class="btn btn-danger col-sm-12"><i class="far fa-window-close" style="font-size:20px;"></i> Sair</a>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
    <div @if(isset ($pesquisa)) class="tab-pane active" @else class="tab-pane" @endif id="nav-dadosAnamnese" role="tabpanel" aria-labelledby="nav-dadosAnamnese-tab">
      <div class="container">

        <form class="navbar-form navbar-left" role="search" action="{{route('tbstatusagenda.pesquisa')}}" method="post">

          <div class="row justify-content-end">
            <div class="col-4">
              {!! csrf_field() !!}
              <input type="text" name="texto" class="form-control" placeholder="Pesquisar por nome. ENTER">
            </div>
          </div>
        </form>

        <table class="table table-hover">
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Símbolo</th>
            <th>Cor</th>
            <th width="100px">Ações</th>
          </tr>
          @foreach ($tbstatusagendas as $tbstatusagenda)
          <tr>
            <td>{{$tbstatusagenda->codigo}}</td>
            <td>{{$tbstatusagenda->nome}}</td>
            <td>{{$tbstatusagenda->dsSimbolo}}</td>
            <td>{{$tbstatusagenda->dsCor}}</td>
            <td>
              <a href="{{route('tbstatusagenda.edit', $tbstatusagenda->codigo)}}" class="actions edit">
                <i class="far fa-edit" style="font-size:20px;"></i>
              </a>
              <a href="{{route('tbstatusagenda.destroy', $tbstatusagenda->codigo)}}" class="actions delete">
                <i class="far fa-trash-alt" style="font-size:20px;"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </table>
        <hr>
        {!! $tbstatusagendas->links() !!}
      </div>
    </div>
  </div>
  @endsection

  <script>
    var colorWell;
    var defaultColor = "#0000ff";
    var dsCor;

    window.addEventListener("load", startup, false);

    function startup() {
      colorWell = document.querySelector("#colorWell");
      colorWell.value = defaultColor;
      colorWell.addEventListener("input", updateFirst, false);
      colorWell.addEventListener("change", updateAll, false);
      colorWell.select();
    }

    function updateFirst(event) {

      dsCor = document.querySelector("#dsCor");
      dsCor.value = colorWell.value;

    }
  </script>