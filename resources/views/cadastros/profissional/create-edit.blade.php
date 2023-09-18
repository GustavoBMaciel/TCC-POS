@extends('layouts.appHome')

@section('content')
<div class="container">

  <div class="panel-heading">{{$tbprofissionalEdit->cdProfissional or 'Novo'}}</div>
  
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
      <a @if(isset ($pesquisa)) class="nav-item nav-link" @else class="nav-item nav-link active" @endif id="nav-dadosPessoais-tab" data-toggle="tab" href="#nav-dadosPessoais" role="tab" aria-controls="nav-dadosPessoais" aria-selected="true">Profissional</a>
      <a @if(isset ($pesquisa)) class="nav-item nav-link active" @else class="nav-item nav-link" @endif id="nav-dadosAnamnese-tab" data-toggle="tab" href="#nav-dadosAnamnese" role="tab" aria-controls="nav-dadosAnamnese" aria-selected="false">Consultar</a>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div @if(isset ($pesquisa)) class="tab-pane" @else class="tab-pane active" @endif id="nav-dadosPessoais" role="tabpanel" aria-labelledby="nav-dadosPessoais-tab">

      @if(isset ($tbprofissionalEdit))
      @foreach ($tbprofissionalEdit as $tbprofissionalEdits)
      @endforeach
      {!! Form::model($tbprofissionalEdits, ['route' => ['profissional.update', $tbprofissionalEdits->cdProfissional ], 'enctype' => 'multipart/form-data', 'class' => 'form', 'method' => 'put']) !!}
      @else
      {!! Form::open(['route' => 'profissional.store', 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}
      @endif
      <div class="form-row align-items-center">
        <div class="form-group col-sm-7 my-1">
          <label style="margin-bottom: -25px;">Nome Médico: </label>
          {!! Form::text('dsNomeMedico', null, ['class' => 'form-control', 'placeholder' => 'EX: Fulano da Silva ']) !!}
        </div>
        <div class="form-group col-sm-4 my-1">
          <label style="margin-bottom: -25px;">CPF: </label>
          {!! Form::text('dsCPF', null, ['class' => 'form-control', 'placeholder' => 'EX: 00000000000']) !!}
        </div>
        <div class="form-group col-sm-1 my-1">
          <label style="margin-bottom: -25px;">Ativo: </label>
          {!! Form::text('dsAtivo', null, ['class' => 'form-control', 'placeholder' => 'EX: S']) !!}
        </div>
      </div>

      <div class="form-row align-items-center">
        <div class="form-group col-sm-6 my-1">
          <label style="margin-bottom: -25px;">CRM: </label>
          {!! Form::text('dsCRM', null, ['class' => 'form-control', 'placeholder' => 'EX: 00000']) !!}
        </div>
        <div class="form-group col-sm-6 my-1">
          <label style="margin-bottom: -25px;">Especialidade: </label>
          {!! Form::text('dsEspecialidade', null, ['class' => 'form-control', 'placeholder' => 'EX: CLÍNICA UROLÓGICA']) !!}
        </div>
      </div>

      <div class="form-row align-items-center">
        <div class="form-group col-sm-5 my-1">
          <label style="margin-bottom: -25px;">Cidade: </label>
          {!! Form::text('dsCidade', null, ['class' => 'form-control', 'placeholder' => 'EX: Belo Horizonte']) !!}
        </div>
        <div class="form-group col-sm-1 my-1">
          <label style="margin-bottom: -25px;">UF: </label>
          {!! Form::text('dsUF', null, ['class' => 'form-control', 'placeholder' => 'EX: MG']) !!}
        </div>
        <div class="form-group col-sm-3 my-1">
          <label style="margin-bottom: -25px;">Telefone: </label>
          {!! Form::text('dsFone', null, ['class' => 'form-control', 'placeholder' => 'EX: 0000000000']) !!}
        </div>
        <div class="form-group col-sm-3 my-1">
          <label style="margin-bottom: -25px;">Celular: </label>
          {!! Form::text('dsCelular', null, ['class' => 'form-control', 'placeholder' => 'EX: 00000000000']) !!}
        </div>
      </div>


      <div class="form-row align-items-center">
        <div class="form-group col-sm-6">
          <button type="submit" style="text-align: center;" class="btn btn-primary col-sm-12"><i class="far fa-save" style="font-size:20px;"></i> Salvar</button>
        </div>

        <div class="form-group col-sm-6">
          <a href="{{route('home')}}" style="text-align: center;" class="btn btn-danger col-sm-12"><i class="far fa-window-close" style="font-size:20px;"></i> Sair</a>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
    <div @if(isset ($pesquisa)) class="tab-pane active" @else class="tab-pane" @endif id="nav-dadosAnamnese" role="tabpanel" aria-labelledby="nav-dadosAnamnese-tab">
      <div class="container">

        <form class="navbar-form navbar-left" role="search" action="{{route('profissional.pesquisa')}}" method="post">

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
            <th>CRM</th>
            <th>CPF</th>
            <th>Especialidade</th>
            <th>Telefone</th>
            <th>Celular</th>
            <th width="100px">Ações</th>
          </tr>
          @foreach ($tbprofissionals as $tbprofissional)
          <tr>
            <td>{{$tbprofissional->cdProfissional}}</td>
            <td>{{$tbprofissional->dsNomeMedico}}</td>
            <td>{{$tbprofissional->dsCRM}}</td>
            <td>{{$tbprofissional->dsCPF}}</td>
            <td>{{$tbprofissional->dsEspecialidade}}</td>
            <td>{{$tbprofissional->dsFone}}</td>
            <td>{{$tbprofissional->dsCelular}}</td>
            <td>
              <a href="{{route('profissional.edit', $tbprofissional->cdProfissional)}}" class="actions edit">
                <i class="far fa-edit" style="font-size:20px;"></i>
              </a>
              <a href="{{route('profissional.destroy', $tbprofissional->cdProfissional)}}" class="actions delete">
                <i class="far fa-trash-alt" style="font-size:20px;"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </table>
        <hr>
        {!! $tbprofissionals->links() !!}
      </div>
    </div>
  </div>
  @endsection