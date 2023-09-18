@extends('layouts.appHome')

@section('content')
<div class="container">

  <div class="panel-heading">{{$fornecedorEdit->id or 'Novo'}}</div>


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
    <div @if(isset ($pesquisa)) class="tab-pane" @else class="tab-pane active" @endif id="nav-dadosPessoais" role="tabpanel" aria-labelledby="nav-dadosPessoais-tab">

      @if(isset ($fornecedorEdit))
      @foreach ($fornecedorEdit as $fornecedorEdits)
      @endforeach
      {!! Form::model($fornecedorEdits, ['route' => ['fornecedor.update', $fornecedorEdits->cod], 'class' => 'form', 'method' => 'PUT', 'type' => 'hidden']) !!}
      @else
      {!! Form::open(['route' => 'fornecedor.store', 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}
      @endif

      <div class="form-row align-items-center">
        <div class="form-group col-sm-8 ">
          <label style="margin-bottom: -25px;">Nome/Razão Social: </label>
          {!! Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'Fulano da Silva:']) !!}
        </div>
        <div class="form-group col-sm-4 my-1">
          <label style="margin-bottom: -25px;">Data de Cadastro: </label>
          <div class="form-group">
            {!! Form::date('dtcad', null, ['class' => 'form-control']) !!}
          </div>
        </div>
      </div>

      <div class="form-row align-items-center">
        <div class="form-group col-sm-8 ">
          <label style="margin-bottom: -25px;">Endereço: </label>
          {!! Form::text('rua', null, ['class' => 'form-control', 'placeholder' => 'EX: Avenida Centro']) !!}
        </div>
        <div class="form-group col-sm-4 ">
          <label style="margin-bottom: -25px;">Numero: </label>
          {!! Form::text('numero', null, ['class' => 'form-control', 'placeholder' => 'Ex: 000']) !!}
        </div>
      </div>

      <div class="form-row align-items-center">
        <div class="form-group col-sm-4 ">
          <label style="margin-bottom: -25px;">Complemento: </label>
          {!! Form::text('compl', null, ['class' => 'form-control', 'placeholder' => 'EX: Apartamento 00']) !!}
        </div>
        <div class="form-group col-sm-4 ">
          <label style="margin-bottom: -25px;">Bairro: </label>
          {!! Form::text('bairro', null, ['class' => 'form-control', 'placeholder' => 'EX: Centro']) !!}
        </div>
        <div class="form-group col-sm-3 ">
          <label style="margin-bottom: -25px;">Cidade: </label>
          {!! Form::text('cidade', null, ['class' => 'form-control', 'placeholder' => 'EX: Belo Horizonte']) !!}
        </div>
        <div class="form-group col-sm-1 ">
          <label style="margin-bottom: -25px;">Estado: </label>
          {!! Form::text('uf', null, ['class' => 'form-control', 'placeholder' => 'EX: MG']) !!}
        </div>
      </div>

      <div class="form-row align-items-center">
        <div class="form-group col-sm-4 ">
          <label style="margin-bottom: -25px;">CEP: </label>
          {!! Form::text('cep', null, ['class' => 'form-control', 'placeholder' => 'EX: 37900-000']) !!}
        </div>
        <div class="form-group col-sm-4 ">
          <label style="margin-bottom: -25px;">Telefone: </label>
          {!! Form::text('fone', null, ['class' => 'form-control', 'placeholder' => 'EX: DD00000000']) !!}
        </div>
        <div class="form-group col-sm-4 ">
          <label style="margin-bottom: -25px;">Celular: </label>
          {!! Form::text('fax', null, ['class' => 'form-control', 'placeholder' => 'EX: DD000000000:']) !!}
        </div>
      </div>

      <div class="form-row align-items-center">
        <div class="form-group col-sm-4 ">
          <label style="margin-bottom: -25px;">CPF/CNPJ: </label>
          {!! Form::text('cgc', null, ['class' => 'form-control', 'placeholder' => 'EX: 00000000000']) !!}
        </div>
        <div class="form-group col-sm-4 ">
          <label style="margin-bottom: -25px;">RG/Inscrição Estadual: </label>
          {!! Form::text('insc', null, ['class' => 'form-control', 'placeholder' => 'EX: MG00000000']) !!}
        </div>
        <div class="form-group col-sm-4 ">
          <label style="margin-bottom: -25px;">Email: </label>
          {!! Form::email('mail', null, ['class' => 'form-control', 'placeholder' => 'EX: teste@teste.com.br']) !!}
        </div>
      </div>

      <div class="form-row align-items-center">
        <div class="form-group col-sm-12 ">
          <label style="margin-bottom: -25px;">Observação: </label>
          {!! Form::textarea('obs', null, ['class' => 'form-control', 'rows' => '5', 'placeholder' => 'EX: Entrega todo dia 15']) !!}
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

        <form class="navbar-form navbar-left" role="search" action="{{route('fornecedor.pesquisa')}}" method="post">

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
            <th>Telefone</th>
            <th width="100px">Ações</th>
          </tr>
          @foreach ($fornecedores as $fornecedor)
          <tr>
            <td>{{$fornecedor->cod}}</td>
            <td>{{$fornecedor->nome}}</td>
            <td>{{$fornecedor->fone}}</td>
            <td>
              <a href="{{route('fornecedor.edit', $fornecedor->cod)}}" class="actions edit">
                <i class="far fa-edit" style="font-size:20px;"></i>
              </a>
              <a href="{{route('fornecedor.destroy', $fornecedor->cod)}}" class="actions delete">
                <i class="far fa-trash-alt" style="font-size:20px;"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </table>
        <hr>
        {!! $fornecedores->links() !!}
      </div>
    </div>
  </div>
  @endsection