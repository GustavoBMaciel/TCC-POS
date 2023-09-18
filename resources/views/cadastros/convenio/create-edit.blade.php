@extends('layouts.appHome')

@section('content')
<div class="container">

  <div class="panel-heading">{{$convenioEdit->id or 'Novo'}}</div>


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
      <a @if(isset ($pesquisa)) class="nav-item nav-link" @else class="nav-item nav-link active" @endif id="nav-dadosPessoais-tab" data-toggle="tab" href="#nav-dadosPessoais" role="tab" aria-controls="nav-dadosPessoais" aria-selected="true">Convênios</a>
      <a @if(isset ($pesquisa)) class="nav-item nav-link active" @else class="nav-item nav-link" @endif id="nav-dadosAnamnese-tab" data-toggle="tab" href="#nav-dadosAnamnese" role="tab" aria-controls="nav-dadosAnamnese" aria-selected="false">Consultar</a>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div  @if(isset ($pesquisa)) class="tab-pane" @else class="tab-pane active" @endif id="nav-dadosPessoais" role="tabpanel" aria-labelledby="nav-dadosPessoais-tab">

      @if(isset ($convenioEdit))
      @foreach ($convenioEdit as $convenioEdits)
      @endforeach
      {!! Form::model($convenioEdits, ['route' => ['convenio.update', $convenioEdits->Cod], 'class' => 'form', 'method' => 'PUT', 'type' => 'hidden']) !!}
      @else
      {!! Form::open(['route' => 'convenio.store', 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}
      @endif

      <div class="form-row align-items-center">
        <div class="form-group col-sm-9 my-1">
          <label style="margin-bottom: -25px;">Nome: </label>
          {!! Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'EX: Santa Casa']) !!}
        </div>

        <div class="form-group col-sm-3 my-1">
          <div class="form-check">
            {!! Form::checkbox('ativo', '1', true) !!}
            <label class="form-check-label" for="defaultCheck2">
              Ativo
            </label>
          </div>
        </div>
      </div>

      <div class="form-row align-items-center">
        <div class="form-group col-sm-12 my-1">
          <label style="margin-bottom: -25px;">Contato: </label>
          {!! Form::text('contato', null, ['class' => 'form-control', 'placeholder' => 'EX: Fulano da Silva']) !!}
        </div>
      </div>

      <div class="form-row align-items-center">
        <div class="form-group col-sm-4 ">
          <label style="margin-bottom: -25px;">Telefone: </label>
          {!! Form::text('fone', null, ['class' => 'form-control', 'placeholder' => 'EX: DD00000000']) !!}
        </div>

        <div class="form-group col-sm-4 my-1">
          <label style="margin-bottom: -25px;">Data de Cadastro: </label>
          <div class="form-group">
            {!! Form::date('dtcad', null, ['class' => 'form-control']) !!}
          </div>
        </div>

        <div class="form-group col-sm-2">
          <label style="margin-bottom: -25px;">Desconto %: </label>
          {!! Form::number('desconto', null, ['class' => 'form-control', 'placeholder' => 'EX: 10']) !!}
        </div>

        <div class="form-group col-sm-2 ">
          <label style="margin-bottom: -25px;">Lançar no Caixa: </label>
          {!! Form::text('lancaCaixa', null, ['class' => 'form-control', 'placeholder' => 'EX: S']) !!}
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
    <div  @if(isset ($pesquisa)) class="tab-pane active" @else class="tab-pane" @endif id="nav-dadosAnamnese" role="tabpanel" aria-labelledby="nav-dadosAnamnese-tab">
      <div class="container">

        <form class="navbar-form navbar-left" role="search" action="{{route('convenio.pesquisa')}}" method="post">

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
            <th>Contato</th>
            <th>Telefone</th>
            <th>Data de Cadastro</th>
            <th>Status</th>
            <th>Desconto %</th>
            <th>Lança Caixa</th>
            <th width="100px">Ações</th>
          </tr>
          @foreach ($convenios as $convenio)
          <tr>
            <td>{{$convenio->Cod}}</td>
            <td>{{$convenio->nome}}</td>
            <td>{{$convenio->contato}}</td>
            <td>{{$convenio->fone}}</td>
            <td>{{$convenio->dtcad}}</td>
            @if($convenio->ativo == 1)
            <td>Ativo</td>
            @else
            <td>Inativo</td>
            @endif
            <td>{{$convenio->desconto}}</td>
            <td>{{$convenio->lancaCaixa}}</td>
            <td>
              <a href="{{route('convenio.edit', $convenio->Cod)}}" class="actions edit">
                <i class="far fa-edit" style="font-size:20px;"></i>
              </a>
              <a href="{{route('convenio.destroy', $convenio->Cod)}}" class="actions delete">
                <i class="far fa-trash-alt" style="font-size:20px;"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </table>
        <hr>
        {!! $convenios->links() !!}
      </div>
    </div>
  </div>
  @endsection