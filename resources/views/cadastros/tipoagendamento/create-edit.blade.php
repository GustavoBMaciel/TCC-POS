@extends('layouts.appHome')

@section('content')
<div class="container">

  <div class="panel-heading">{{$tbtipoagendamentoEdit->cdTipoAgendamento or 'Novo'}}</div>


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
    <div @if(isset ($pesquisa)) class="tab-pane" @else class="tab-pane active" @endif id="nav-dadosPessoais" role="tabpanel" aria-labelledby="nav-dadosPessoais-tab">

      @if(isset ($tbtipoagendamentoEdit))
      @foreach ($tbtipoagendamentoEdit as $tbtipoagendamentoEdits)
      @endforeach
      {!! Form::model($tbtipoagendamentoEdits, ['route' => ['tbtipoagendamento.update', $tbtipoagendamentoEdits->cdTipoAgendamento ], 'enctype' => 'multipart/form-data', 'class' => 'form', 'method' => 'put']) !!}
      @else
      {!! Form::open(['route' => 'tbtipoagendamento.store', 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}
      @endif

      <div class="form-row align-items-center">
        <div class="form-group col-sm-8 my-1">
          <label style="margin-bottom: -25px;">Nome: </label>
          {!! Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'EX: Retorno']) !!}
        </div>

        <div class="form-group col-sm-4 my-1">
          <label style="margin-bottom: -25px;">Profissional/Médico: </label>
          <select name="cdProfissional" class="form-control">
            @if( !isset ($tbtipoagendamentoEdit[0]->cdTipoAgendamento))
            <option value="0">Profissional</option>
            @else
            @foreach ($tbtipoagendamentoEdit as $tbtipoagendamentoEdits)
            <option value="{{$tbtipoagendamentoEdits->cdProfissional}}">{{$tbtipoagendamentoEdits->dsNomeMedico}}</option>
            @endforeach
            @endif
            @foreach ($cdProfissionais as $cdProfissional)
            <option value="{{$cdProfissional->cdProfissional}}">{{$cdProfissional->dsNomeMedico}}</option>
            @endforeach
          </select>
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

        <form class="navbar-form navbar-left" role="search" action="{{route('tbtipoagendamento.pesquisa')}}" method="post">

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
            <th>Profissional/Médico</th>
            <th width="100px">Ações</th>
          </tr>
          @foreach ($tbtipoagendamentos as $tbtipoagendamento)
          <tr>
            <td>{{$tbtipoagendamento->cdTipoAgendamento}}</td>
            <td>{{$tbtipoagendamento->nome}}</td>
            <td>{{$tbtipoagendamento->dsNomeMedico}}</td>
            <td>
              <a href="{{route('tbtipoagendamento.edit', $tbtipoagendamento->cdTipoAgendamento)}}" class="actions edit">
                <i class="far fa-edit" style="font-size:20px;"></i>
              </a>
              <a href="{{route('tbtipoagendamento.destroy', $tbtipoagendamento->cdTipoAgendamento)}}" class="actions delete">
                <i class="far fa-trash-alt" style="font-size:20px;"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </table>
        <hr>
        {!! $tbtipoagendamentos->links() !!}
      </div>
    </div>
  </div>
  @endsection