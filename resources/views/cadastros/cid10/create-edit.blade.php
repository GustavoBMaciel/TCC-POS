@extends('layouts.appHome')

@section('content')
<div class="container">

  <div class="panel-heading">{{$clienteEdit[0]->nome or 'Novo'}}</div>


  @if( isset ($errors) && count ($errors) > 0 )
  <div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Restrições!</h4>
    @foreach( $errors->all() as $error )
    <p>{{$error}} </p>
    @endforeach
  </div>
  @endif

  @if(isset ($clienteEdit))
  @foreach ($clienteEdit as $clienteEdits)
  @endforeach
  {!! Form::model($clienteEdits, ['route' => ['cliente.update', $clienteEdits->Cod ], 'enctype' => 'multipart/form-data', 'method' => 'put']) !!}
  @else
  {!! Form::open(['route' => 'cliente.store', 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}
  @endif

  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-item nav-link active" id="nav-dadosPessoais-tab" data-toggle="tab" href="#nav-dadosPessoais" role="tab" aria-controls="nav-dadosPessoais" aria-selected="true">Dados Pessoais</a>
      @if( !isset ($clienteEdit[0]->Cod))
      <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Dados Anamnese</a>
      @else
      <a class="nav-item nav-link" id="nav-dadosAnamnese-tab" data-toggle="tab" href="#nav-dadosAnamnese" role="tab" aria-controls="nav-dadosAnamnese" aria-selected="false">Dados Anamnese</a>
      @endif
      <a class="nav-item nav-link" id="nav-imagens-tab" data-toggle="tab" href="#nav-imagens" role="tab" aria-controls="nav-imagens" aria-selected="false">Imagens</a>
      <a class="nav-item nav-link" id="nav-agendamentos-tab" data-toggle="tab" href="#nav-agendamentos" role="tab" aria-controls="nav-agendamentos" aria-selected="false">Agendamentos</a>
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-dadosPessoais" role="tabpanel" aria-labelledby="nav-dadosPessoais-tab">
      <div class="form-group ">
        {!! Form::file('foto', null, ['class' => 'form-control', 'placeholder' => 'Foto:']) !!}
      </div>

      <div class="form-row align-items-center">
        <div class="form-group col-sm-4 my-1">
          <select name="tipo" class="form-control">
            <option value="">Tipo</option>
            @foreach ($tipos as $tipo)
            <option value="{{$tipo->nome}}">{{$tipo->nome}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-sm-1 my-1">
          <a href="{{route('tipo.create')}}" class="btn btn-success form-control col-12"><i class="fas fa-plus-square" style="font-size:22px;"></i></a>
        </div>

        <div class="col-auto col-sm-1 my-1">
          <div class="form-check">
            {!! Form::checkbox('ativo', '1', true) !!}
            <label class="form-check-label" for="defaultCheck2">
              Ativo
            </label>
          </div>
        </div>

        <div class="form-group col-sm-3">
          <label>Data da 1º Primeira Consulta</label>
          <div class="form-group">
            {!! Form::date('dtnasc', null, ['class' => 'form-control']) !!}
          </div>
        </div>

        <div class="form-group col-sm-3">
          <label>Data de Nascimento</label>
          <div class="form-group">
            {!! Form::date('dtcad', null, ['class' => 'form-control']) !!}
          </div>
        </div>
      </div>

      <div class="form-row align-items-center">
        <div class="form-group col-sm-8">
          {!! Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'Nome:']) !!}
        </div>

        <div class="form-group col-sm-4">
          {!! Form::text('dsCPF', null, ['class' => 'form-control', 'placeholder' => 'CPF:']) !!}
        </div>
      </div>

      <div class="form-row align-items-center">
        <div class="form-group col-sm-8">
          {!! Form::text('rua', null, ['class' => 'form-control', 'placeholder' => 'Rua:']) !!}
        </div>

        <div class="form-group col-sm-4">
          {!! Form::number('numero', null, ['class' => 'form-control', 'placeholder' => 'Numero:']) !!}
        </div>

        <div class="form-group col-sm-4">
          {!! Form::text('compl', null, ['class' => 'form-control', 'placeholder' => 'Complemento:']) !!}
        </div>

        <div class="form-group col-sm-4">
          {!! Form::text('Bairro', null, ['class' => 'form-control', 'placeholder' => 'Bairro:']) !!}
        </div>

        <div class="form-group col-sm-4">
          {!! Form::text('CEP', null, ['class' => 'form-control', 'placeholder' => 'CEP:']) !!}
        </div>
      </div>

      <div class="form-row align-items-center">
        <div class="form-group col-sm-5">
          {!! Form::text('Cidade', null, ['class' => 'form-control', 'placeholder' => 'Cidade:']) !!}
        </div>

        <div class="form-group col-sm-2">
          {!! Form::text('uf', null, ['class' => 'form-control', 'placeholder' => 'Estado:']) !!}
        </div>

        <div class="form-group col-sm-5">
          {!! Form::text('Responsavel', null, ['class' => 'form-control', 'placeholder' => 'Responsável:']) !!}
        </div>
      </div>

      <div class="form-row align-items-center">
        <div class="form-group col-sm-3">
          {!! Form::text('fone', null, ['class' => 'form-control', 'placeholder' => 'Telefone:']) !!}
        </div>

        <div class="form-group col-sm-3">
          {!! Form::text('celular', null, ['class' => 'form-control', 'placeholder' => 'Celular:']) !!}
        </div>

        <div class="form-group col-sm-3">
          {!! Form::email('dsEmail', null, ['class' => 'form-control', 'placeholder' => 'Email:']) !!}
        </div>

        <div class="form-group col-sm-3">
          {!! Form::text('dsCartaoConvenio', null, ['class' => 'form-control', 'placeholder' => 'Cartão Convenio:']) !!}
        </div>
      </div>

      <div class="form-group">
        {!! Form::textarea('Obs', null, ['class' => 'form-control', 'rows' => '5', 'placeholder' => 'Observação:']) !!}
      </div>

      <div class="form-row align-items-center">
        <div class="form-group col-sm-4">
          <select name="sexo" class="form-control">
            <option value="">Sexo</option>
            @foreach ($sexos as $Sexo)
            <option value="{{$Sexo}}">{{$Sexo}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group col-sm-3">
          <select name="convenio" class="form-control">
            <option value="">Convenio</option>
            @foreach ($convenios as $convenio)
            <option value="{{$convenio->cod}}">{{$convenio->nome}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-sm-1">
          <a href="{{route('convenio.create')}}" class="btn btn-success form-control col-12"><i class="fas fa-plus-square" style="font-size:22px;"></i></a>
        </div>

        <div class="form-group col-sm-3">
          <select name="profissao" class="form-control">
            <option value="">Profissão</option>
            @foreach ($profissoes as $profissao)
            <option value="{{$profissao->codigo}}">{{$profissao->nome}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-sm-1">
          <a href="{{route('profissao.create')}}" class="btn btn-success form-control col-12"><i class="fas fa-plus-square" style="font-size:22px;"></i></a>
        </div>
      </div>

      <div class="form-row align-items-center">
        <div class="form-group col-sm-2">
          <button type="submit" style="text-align: center;" class="btn btn-primary col-sm-12"><i class="far fa-save" style="font-size:20px;"></i> Salvar</button>
        </div>
        <div class="form-group col-sm-2">
          <button type="" style="text-align: center;" class="btn btn-primary col-sm-12"><i class="fas fa-print" style="font-size:20px;"></i> Imprimir Cadastro</button>
        </div>
        <div class="form-group col-sm-2">
          <a href="{{route('cliente.index')}}" style="text-align: center;" class="btn btn-primary col-sm-12"><i class="fas fa-search" style="font-size:20px;"></i> Consultar</a>
        </div>
        <div class="form-group col-sm-2">
          <button type="" style="text-align: center;" class="btn btn-primary col-sm-12"><i class="fas fa-laptop-medical" style="font-size:20px;"></i> Prox. Consulta</button>
        </div>
        <div class="form-group col-sm-2">
          @if( !isset ($clienteEdits->Cod))
          <button type="" class="btn btn-secondary col-sm-12" style="text-align: center;" disabled><i class="fas fa-notes-medical" style="font-size:20px;"></i> Anamnese</button>
          @else
          <button type="" class="btn btn-primary col-sm-12" style="text-align: center;"><i class="fas fa-notes-medical" style="font-size:20px;"></i> Anamnese</button>
          @endif
        </div>
        <div class="form-group col-sm-2">
          <a href="{{route('cliente.index')}}" style="text-align: center;" class="btn btn-danger col-sm-12"><i class="far fa-window-close" style="font-size:20px;"></i> Sair</a>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="nav-dadosAnamnese" role="tabpanel" aria-labelledby="nav-dadosAnamnese-tab"></div>
    <div class="tab-pane fade" id="nav-imagens" role="tabpanel" aria-labelledby="nav-imagens-tab">
      <div class="form-row align-items-center">
        <div class="form-group col-sm-6">
          {!! Form::label('img', 'Imagem 01', ['class' => 'color-blue']) !!}
          {!! Form::textarea('obsFoto1', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Observação:']) !!}
          {!! Form::file('localFoto1', null, ['class' => 'form-control', 'placeholder' => 'Foto:']) !!}
        </div>
        <div class="form-group col-sm-6">
          {!! Form::label('img', 'Imagem 05', ['class' => 'color-blue']) !!}
          {!! Form::textarea('obsFoto5', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Observação:']) !!}
          {!! Form::file('localFoto5', null, ['class' => 'form-control', 'placeholder' => 'Foto:']) !!}
        </div>
        <div class="form-group col-sm-6">
          {!! Form::label('img', 'Imagem 02', ['class' => 'color-blue']) !!}
          {!! Form::textarea('obsFoto2', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Observação:']) !!}
          {!! Form::file('localFoto2', null, ['class' => 'form-control', 'placeholder' => 'Foto:']) !!}
        </div>
        <div class="form-group col-sm-6">
          {!! Form::label('img', 'Imagem 06', ['class' => 'color-blue']) !!}
          {!! Form::textarea('obsFoto6', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Observação:']) !!}
          {!! Form::file('localFoto6', null, ['class' => 'form-control', 'placeholder' => 'Foto:']) !!}
        </div>
        <div class="form-group col-sm-6">
          {!! Form::label('img', 'Imagem 03', ['class' => 'color-blue']) !!}
          {!! Form::textarea('obsFoto3', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Observação:']) !!}
          {!! Form::file('localFoto3', null, ['class' => 'form-control', 'placeholder' => 'Foto:']) !!}
        </div>
        <div class="form-group col-sm-6">
          {!! Form::label('img', 'Imagem 07', ['class' => 'color-blue']) !!}
          {!! Form::textarea('obsFoto7', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Observação:']) !!}
          {!! Form::file('localFoto7', null, ['class' => 'form-control', 'placeholder' => 'Foto:']) !!}
        </div>
        <div class="form-group col-sm-6">
          {!! Form::label('img', 'Imagem 04', ['class' => 'color-blue']) !!}
          {!! Form::textarea('obsFoto4', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Observação:']) !!}
          {!! Form::file('localFoto4', null, ['class' => 'form-control', 'placeholder' => 'Foto:']) !!}
        </div>
        <div class="form-group col-sm-6">
          {!! Form::label('img', 'Imagem 08', ['class' => 'color-blue']) !!}
          {!! Form::textarea('obsFoto8', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Observação:']) !!}
          {!! Form::file('localFoto8', null, ['class' => 'form-control', 'placeholder' => 'Foto:']) !!}
        </div>

      </div>
    </div>

    <div class="tab-pane fade" id="nav-agendamentos" role="tabpanel" aria-labelledby="nav-agendamentos-tab">...</div>
  </div>

</div>
{!! Form::close() !!}
@endsection