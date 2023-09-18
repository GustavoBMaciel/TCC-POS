@extends('layouts.appHome')

@section('content')
<div class="container">

  <div class="panel-heading">{{$acessoEdit->Usuario or 'Novo'}}</div>


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
      <a @if(isset ($pesquisa)) class="nav-item nav-link" @else class="nav-item nav-link active" @endif id="nav-dadosPessoais-tab" data-toggle="tab" href="#nav-dadosPessoais" role="tab" aria-controls="nav-dadosPessoais" aria-selected="true">Usuários</a>
      <a @if(isset ($pesquisa)) class="nav-item nav-link active" @else class="nav-item nav-link" @endif id="nav-dadosAnamnese-tab" data-toggle="tab" href="#nav-dadosAnamnese" role="tab" aria-controls="nav-dadosAnamnese" aria-selected="false">Consultar</a>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div  @if(isset ($pesquisa)) class="tab-pane" @else class="tab-pane active" @endif id="nav-dadosPessoais" role="tabpanel" aria-labelledby="nav-dadosPessoais-tab">

      @if(isset ($acessoEdit))
      @foreach ($acessoEdit as $acessoEdits)
      @endforeach
      {!! Form::model($acessoEdits, ['route' => ['acesso.update', $acessoEdits->codigo ], 'enctype' => 'multipart/form-data', 'class' => 'form', 'method' => 'put']) !!}
      @else
      <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
        @csrf

        @endif

        <div class="form-row align-items-center">
          <div class="form-group col-sm-8 ">
            <label style="margin-bottom: -25px;">Nome: </label>
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'EX: Fulano da Silva']) !!}
          </div>

          <div class="form-group col-sm-1 my-1">
            <div class="form-check">
              {!! Form::checkbox('ativo', '1', true) !!}
              <label class="form-check-label" for="defaultCheck2">
                Ativo
              </label>
            </div>
          </div>

          <div class="form-group col-sm-3 my-1">
            <label style="margin-bottom: -25px;">Data de Cadastro: </label>
            <div class="form-group">
              {!! Form::date('dataCadastro', null, ['class' => 'form-control']) !!}
            </div>
          </div>
        </div>

        <div class="form-row align-items-center">
          <div class="form-group col-sm-6 ">
            <label style="margin-bottom: -25px;">Telefone: </label>
            {!! Form::text('fone', null, ['class' => 'form-control', 'placeholder' => 'EX: DD00000000']) !!}
          </div>
          <div class="form-group col-sm-6 my-1">
            <label style="margin-bottom: -25px;">Senha: </label>
            {!! Form::password('password', null, ['class' => 'form-control', 'placeholder' => 'EX: 1234']) !!}
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
      </form>
    </div>
    <div @if(isset ($pesquisa)) class="tab-pane active" @else class="tab-pane" @endif id="nav-dadosAnamnese" role="tabpanel" aria-labelledby="nav-dadosAnamnese-tab">
      <div class="container">

        <form class="navbar-form navbar-left" role="search" action="{{route('acesso.pesquisa')}}" method="post">

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
            <th>Data de Cadastro</th>
            <th>Telefone</th>
            <th width="100px">Ações</th>
          </tr>
          @foreach ($acessos as $acesso)
          <tr>
            <td>{{$acesso->codigo}}</td>
            <td>{{$acesso->Usuario}}</td>
            <td>{{$acesso->dataCadastro}}</td>
            <td>{{$acesso->fone}}</td>
            <td>
              <a href="{{route('acesso.edit', $acesso->codigo)}}" class="actions edit">
                <i class="far fa-edit" style="font-size:20px;"></i>
              </a>
              <a href="{{route('acesso.destroy', $acesso->codigo)}}" class="actions delete">
                <i class="far fa-trash-alt" style="font-size:20px;"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </table>
        <hr>
        {!! $acessos->links() !!}
      </div>
    </div>
  </div>
  @endsection