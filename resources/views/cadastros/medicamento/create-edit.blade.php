@extends('layouts.appHome')

@section('content')
<div class="container">

  <div class="panel-heading">{{$medicamentoEdit->nome or 'Novo'}}</div>


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
      <a @if(isset ($pesquisa)) class="nav-item nav-link" @else class="nav-item nav-link active" @endif id="nav-dadosPessoais-tab" data-toggle="tab" href="#nav-dadosPessoais" role="tab" aria-controls="nav-dadosPessoais" aria-selected="true">Medicamentos</a>
      <a @if(isset ($pesquisa)) class="nav-item nav-link active" @else class="nav-item nav-link" @endif id="nav-dadosAnamnese-tab" data-toggle="tab" href="#nav-dadosAnamnese" role="tab" aria-controls="nav-dadosAnamnese" aria-selected="false">Consultar</a>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div @if(isset ($pesquisa)) class="tab-pane" @else class="tab-pane active" @endif id="nav-dadosPessoais" role="tabpanel" aria-labelledby="nav-dadosPessoais-tab">

      @if(isset ($medicamentoEdit))
      @foreach ($medicamentoEdit as $medicamentoEdits)
      @endforeach
      {!! Form::model($medicamentoEdits, ['route' => ['medicamento.update', $medicamentoEdits->codigo ], 'enctype' => 'multipart/form-data', 'class' => 'form', 'method' => 'put']) !!}
      @else
      {!! Form::open(['route' => 'medicamento.store', 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}
      @endif

      <div class="form-row align-items-center">
        <div class="form-group col-sm-4 my-1">
          <label style="margin-bottom: -25px;">Nome Generico: </label>
          {!! Form::text('nomeGenerico', null, ['class' => 'form-control', 'placeholder' => 'EX: PARACETAMOL']) !!}
        </div>
        <div class="form-group col-sm-4 my-1">
          <label style="margin-bottom: -25px;">Nome de Fabrica: </label>
          {!! Form::text('nomeFabrica', null, ['class' => 'form-control', 'placeholder' => 'EX: PACEMOL']) !!}
        </div>
        <div class="form-group col-sm-4 my-1">
          <label style="margin-bottom: -25px;">Fabricante: </label>
          {!! Form::text('fabricante', null, ['class' => 'form-control', 'placeholder' => 'EX: ANVISA']) !!}
        </div>
      </div>

      <div class="form-row align-items-center">
        <div class="form-group col-sm-6 my-1">
          <label style="margin-bottom: -25px;">Concentração: </label>
          {!! Form::text('concentracao', null, ['class' => 'form-control', 'placeholder' => 'EX: 750 MG']) !!}
        </div>
        <div class="form-group col-sm-6 my-1">
          <label style="margin-bottom: -25px;">Administração: </label>
          <select name="administracao" class="form-control">
          @if( !isset ($medicamentoEdit[0]->codigo))
            <option value="0">Administração</option>
            @else
            @foreach ($medicamentoEdit as $medicamentoEdits)
            <option value="{{$medicamentoEdits->administracao}}">{{$medicamentoEdits->administracao}}</option>
            @endforeach
            @endif
            @foreach ($administracoes as $administracao)
            <option value="{{$administracao}}">{{$administracao}}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-row align-items-center">
        <div class="form-group col-sm-12 my-1">
          <label style="margin-bottom: -25px;">Posologia: </label>
          {!! Form::textarea('posologia', null, ['class' => 'form-control', 'rows' => '5', 'placeholder' => 'EX: Redução da febre e para o alívio temporário de dores leves a moderadas']) !!}
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

        <form class="navbar-form navbar-left" role="search" action="{{route('medicamento.pesquisa')}}" method="post">

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
            <th>Nome Generico</th>
            <th>Nome de Fabrica</th>
            <th>Fabricante</th>
            <th>Concentração</th>
            <th>Administração</th>
            <th>Posologia</th>
            <th width="100px">Ações</th>
          </tr>
          @foreach ($medicamentos as $medicamento)
          <tr>
            <td>{{$medicamento->codigo}}</td>
            <td>{{$medicamento->nomeGenerico}}</td>
            <td>{{$medicamento->nomeFabrica}}</td>
            <td>{{$medicamento->fabricante}}</td>
            <td>{{$medicamento->concentracao}}</td>
            <td>{{$medicamento->administracao}}</td>
            <td>{{$medicamento->posologia}}</td>
            <td>
              <a href="{{route('medicamento.edit', $medicamento->codigo)}}" class="actions edit">
                <i class="far fa-edit" style="font-size:20px;"></i>
              </a>
              <a href="{{route('medicamento.destroy', $medicamento->codigo)}}" class="actions delete">
                <i class="far fa-trash-alt" style="font-size:20px;"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </table>
        <hr>
        {!! $medicamentos->links() !!}
      </div>
    </div>
  </div>
  @endsection