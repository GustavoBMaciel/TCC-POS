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
      @if( !isset ($clienteEdit[0]->Cod))
      <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Agendamentos</a>
      @else
      <a class="nav-item nav-link" id="nav-agendamentos-tab" data-toggle="tab" href="#nav-agendamentos" role="tab" aria-controls="nav-agendamentos" aria-selected="false">Agendamentos</a>
      @endif
      @if( !isset ($clienteEdit[0]->Cod))
      <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Medicamentos</a>
      @else
      <a class="nav-item nav-link" id="nav-medicamentos-tab" data-toggle="tab" href="#nav-medicamentos" role="tab" aria-controls="nav-medicamentos" aria-selected="false">Medicamentos</a>
      @endif
      @if( !isset ($clienteEdit[0]->Cod))
      <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Exames</a>
      @else
      <a class="nav-item nav-link" id="nav-exames-tab" data-toggle="tab" href="#nav-exames" role="tab" aria-controls="nav-exames" aria-selected="false">Exames</a>
      @endif
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-dadosPessoais" role="tabpanel" aria-labelledby="nav-dadosPessoais-tab">
      <div class="form-row align-items-center">
        <div class="form-group col-sm-6  my-1">
          <label style="margin-bottom: -25px;">Foto: </label>
          {!! Form::file('foto', null, ['class' => 'form-control', 'placeholder' => 'Foto:']) !!}
        </div>
        <div class="form-group col-sm-6  my-1">
          @if( isset ($clienteEdit[0]->Cod))
          <img width="150px" src="{{ url('/fotoPacientes' , $clienteEdit[0]->foto )}}" alt="">
          @endif
        </div>
      </div>


      <div class="form-row align-items-center">
        <div class="form-group col-sm-4">
          <label style="margin-bottom: -25px;">Tipo do Paciente</label>
          <select name="tipo" class="form-control">
            @if( !isset ($clienteEdit[0]->Cod))
            <option value="0">Tipo</option>
            @else
            @foreach ($clienteEdit as $clienteEdits)
            <option value="{{$clienteEdits->tipo}}">{{$clienteEdits->tipo}}</option>
            @endforeach
            @endif
            @foreach ($tipos as $tipo)
            <option value="{{$tipo->nome}}">{{$tipo->nome}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-sm-1 ">
          <a style="margin-bottom: -20px;" href="{{route('tipo.create')}}" class="btn btn-success form-control "><i class="fas fa-plus-square" style="font-size:22px;"></i></a>
        </div>

        <div class="col-auto col-sm-1">
          <div class="form-check">
            {!! Form::checkbox('ativo', '1', true) !!}
            <label class="form-check-label" for="defaultCheck2">
              Ativo
            </label>
          </div>
        </div>

        <div class="form-group col-sm-3  my-1">
          <label style="margin-bottom: -25px;">Data da 1º Primeira Consulta</label>
          <div class="form-group">
            {!! Form::date('dtnasc', null, ['class' => 'form-control']) !!}
          </div>
        </div>

        <div class="form-group col-sm-3  my-1">
          <label style="margin-bottom: -25px;">Data de Nascimento</label>
          <div class="form-group">
            {!! Form::date('dtcad', null, ['class' => 'form-control']) !!}
          </div>
        </div>
      </div>

      <div class="form-row align-items-center">
        <div class="form-group col-sm-8">
          <label style="margin-bottom: -25px;">Nome do Paciente</label>
          {!! Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'EX: Fulano da Silva']) !!}
        </div>

        <div class="form-group col-sm-4">
          <label style="margin-bottom: -25px;">CPF</label>
          {!! Form::text('dsCPF', null, ['class' => 'form-control', 'placeholder' => 'EX: 00000000000']) !!}
        </div>
      </div>

      <div class="form-row align-items-center">
        <div class="form-group col-sm-8">
          <label style="margin-bottom: -25px;">Endereço</label>
          {!! Form::text('rua', null, ['class' => 'form-control', 'placeholder' => 'EX: Avenida centro']) !!}
        </div>

        <div class="form-group col-sm-4">
          <label style="margin-bottom: -25px;">Numero</label>
          {!! Form::number('numero', null, ['class' => 'form-control', 'placeholder' => 'EX: 000']) !!}
        </div>

        <div class="form-group col-sm-4">
          <label style="margin-bottom: -25px;">Complemento</label>
          {!! Form::text('compl', null, ['class' => 'form-control', 'placeholder' => 'EX: Apartamento 000']) !!}
        </div>

        <div class="form-group col-sm-4">
          <label style="margin-bottom: -25px;">Bairro</label>
          {!! Form::text('Bairro', null, ['class' => 'form-control', 'placeholder' => 'EX: Centro']) !!}
        </div>

        <div class="form-group col-sm-4">
          <label style="margin-bottom: -25px;">CEP</label>
          {!! Form::text('CEP', null, ['class' => 'form-control', 'placeholder' => 'EX: 37900-000']) !!}
        </div>
      </div>

      <div class="form-row align-items-center">
        <div class="form-group col-sm-5">
          <label style="margin-bottom: -25px;">Cidade</label>
          {!! Form::text('Cidade', null, ['class' => 'form-control', 'placeholder' => 'EX: Belo Horizonte']) !!}
        </div>

        <div class="form-group col-sm-2">
          <label style="margin-bottom: -25px;">Estado</label>
          {!! Form::text('uf', null, ['class' => 'form-control', 'placeholder' => 'EX: MG']) !!}
        </div>

        <div class="form-group col-sm-5">
          <label style="margin-bottom: -25px;">Responsável</label>
          {!! Form::text('Responsavel', null, ['class' => 'form-control', 'placeholder' => 'Ex: O Filho, Fulano da Silva']) !!}
        </div>
      </div>

      <div class="form-row align-items-center">
        <div class="form-group col-sm-3">
          <label style="margin-bottom: -25px;">Telefone</label>
          {!! Form::text('fone', null, ['class' => 'form-control', 'placeholder' => 'Ex:DD000000000']) !!}
        </div>

        <div class="form-group col-sm-3">
          <label style="margin-bottom: -25px;">Celular</label>
          {!! Form::text('celular', null, ['class' => 'form-control', 'placeholder' => 'Ex:DD000000000']) !!}
        </div>

        <div class="form-group col-sm-3">
          <label style="margin-bottom: -25px;">E-mail</label>
          {!! Form::email('dsEmail', null, ['class' => 'form-control', 'placeholder' => 'Ex: teste@teste.com.br']) !!}
        </div>

        <div class="form-group col-sm-3">
          <label style="margin-bottom: -25px;">Nº Cartão Convenio</label>
          {!! Form::text('dsCartaoConvenio', null, ['class' => 'form-control', 'placeholder' => 'EX: 123456789']) !!}
        </div>
      </div>

      <div class="form-group">
        <label style="margin-bottom: -25px;">Observação</label>
        {!! Form::textarea('Obs', null, ['class' => 'form-control', 'rows' => '5', 'placeholder' => 'EX: Paciente prefere atendimento após o meio dia']) !!}
      </div>

      <div class="form-row align-items-center">
        <div class="form-group col-sm-4">
          <label style="margin-bottom: -25px;">Sexo</label>
          <select name="Sexo" class="form-control">
            @if( !isset ($clienteEdit[0]->Cod))
            <option value="">Sexo</option>
            @else
            @if ($clienteEdit[0]->sexo = 1)
            <option value="1">Masculino</option>
            @else
            <option value="0">Feminino</option>
            @endif
            @endif
            @foreach ($sexos as $sexo)
            <option value="{{$sexo}}">{{$sexo}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group col-sm-3">
          <label style="margin-bottom: -25px;">Convenio</label>
          <select name="convenio" class="form-control">
            @if( !isset ($clienteEdit[0]->Cod))
            <option value="0">convenio</option>
            @else
            @foreach ($clienteEdit as $clienteEdits)
            <option value="{{$clienteEdits->convenio}}">{{$convenioPaci}}</option>
            @endforeach
            @endif
            @foreach ($convenios as $convenio)
            <option value="{{$convenio->cod}}">{{$convenio->nome}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-sm-1">
          <a style="margin-bottom: -20px;" href="{{route('convenio.create')}}" class="btn btn-success form-control col-12"><i class="fas fa-plus-square" style="font-size:22px;"></i></a>
        </div>

        <div class="form-group col-sm-3">
          <label style="margin-bottom: -25px;">Profissão</label>
          <select name="profissao" class="form-control">
            @if( !isset ($clienteEdit[0]->Cod))
            <option value="0">Profissão</option>
            @else
            @foreach ($clienteEdit as $clienteEdits)
            <option value="{{$clienteEdits->profissao}}">{{$profissaoPaci}}</option>
            @endforeach
            @endif
            @foreach ($profissoes as $profissao)
            <option value="{{$profissao->codigo}}">{{$profissao->nome}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-sm-1">
          <a style="margin-bottom: -20px;" href="{{route('profissao.create')}}" class="btn btn-success form-control col-12"><i class="fas fa-plus-square" style="font-size:22px;"></i></a>
        </div>
      </div>

      <div class="form-row align-items-center">
        <div class="form-group col-sm-2">
          <button type="submit" style="text-align: center;" class="btn btn-primary col-sm-12"><i class="far fa-save" style="font-size:20px;"></i> Salvar</button>
        </div>
        <div class="form-group col-sm-2">
          @if( !isset ($clienteEdits->Cod))
          <a href="#" style="text-align: center;" class="btn btn-secondary dropdown-item disabled"><i class="fas fa-print" style="font-size:20px;"></i> Imprimir Cadastro</a>
          @else
          <a href="{{route('cliente.pdf', $clienteEdit[0]->Cod)}}" style="text-align: center;" class="btn btn-primary col-sm-12"><i class="fas fa-printl" style="font-size:20px;"></i> Imprimir Cadastro</a>
          @endif
        </div>
        <div class="form-group col-sm-2">
          <a href="{{route('cliente.index')}}" style="text-align: center;" class="btn btn-primary col-sm-12"><i class="fas fa-search" style="font-size:20px;"></i> Consultar</a>
        </div>
        <div class="form-group col-sm-2">
          @if( !isset ($clienteEdits->Cod))
          <a href="#" style="text-align: center;" class="btn btn-secondary dropdown-item disabled"><i class="fas fa-laptop-medical" style="font-size:20px;"></i> Prox. Consulta</a>
          @else
          <a href="{{route('cliente.show', $clienteEdit[0]->Cod)}}" style="text-align: center;" class="btn btn-primary col-sm-12"><i class="fas fa-laptop-medical" style="font-size:20px;"></i> Prox. Consulta</a>
          @endif
        </div>
        <div class="form-group col-sm-2">
          @if( !isset ($clienteEdits->Cod))
          <a href="#" style="text-align: center;" class="btn btn-secondary dropdown-item disabled"><i class="fas fa-notes-medical" style="font-size:20px;"></i> Cadastrar Anamnese</a>
          @else
          <a href="{{route('anamnese.create')}}" style="text-align: center;" class="btn btn-primary col-sm-12"><i class="fas fa-notes-medical" style="font-size:20px;"></i> Cadastrar Anamnese</a>
          @endif
        </div>
        <div class="form-group col-sm-2">
          <a href="{{route('cliente.index')}}" style="text-align: center;" class="btn btn-danger col-sm-12"><i class="far fa-window-close" style="font-size:20px;"></i> Sair</a>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="nav-dadosAnamnese" role="tabpanel" aria-labelledby="nav-dadosAnamnese-tab">
      <div class="panel-heading">Listagem de Anamneses do Paciente</div>
      <table class="table table-hover">
        <tr>
          <th>ID</th>
          <th>Cod. Paciente</th>
          <th>Data da Consulta</th>
          <th>Profissional</th>
          <th width="100px">Ações</th>
        </tr>
        @foreach ($anamneses as $anamnese)
        <tr>
          <td>{{$anamnese->cdCodigo}}</td>
          <td>{{$anamnese->CodigoPaciente}}</td>
          <td>{{$anamnese->data}}</td>
          <td>{{$anamnese->cdProfissional}}</td>
          <td>
            <a href="{{route('anamnese.edit', $anamnese->cdCodigo)}}" class="actions edit">
              <i class="far fa-edit" style="font-size:20px;"></i>
            </a>
            <a href="{{route('anamnese.show', $anamnese->cdCodigo)}}" class="actions delete">
              <span class="glyphicon glyphicon-eye-open"></span>
            </a>
          </td>
        </tr>
        @endforeach
      </table>
    </div>
    <div class="tab-pane fade" id="nav-imagens" role="tabpanel" aria-labelledby="nav-imagens-tab">
      <div class="form-row align-items-center">
        <div class="form-group col-sm-6">
          {!! Form::label('img', 'Imagem 01', ['class' => 'color-blue']) !!}
          {!! Form::textarea('obsFoto1', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Observação foto 01:']) !!}
          {!! Form::file('localFoto1', null, ['class' => 'form-control', 'placeholder' => 'Foto:']) !!}
        </div>
        <div class="form-group col-sm-6">
          {!! Form::label('img', 'Imagem 05', ['class' => 'color-blue']) !!}
          {!! Form::textarea('obsFoto5', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Observação foto 05:']) !!}
          {!! Form::file('localFoto5', null, ['class' => 'form-control', 'placeholder' => 'Foto:']) !!}
        </div>
        <div class="form-group col-sm-6">
          {!! Form::label('img', 'Imagem 02', ['class' => 'color-blue']) !!}
          {!! Form::textarea('obsFoto2', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Observação foto 02:']) !!}
          {!! Form::file('localFoto2', null, ['class' => 'form-control', 'placeholder' => 'Foto:']) !!}
        </div>
        <div class="form-group col-sm-6">
          {!! Form::label('img', 'Imagem 06', ['class' => 'color-blue']) !!}
          {!! Form::textarea('obsFoto6', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Observação foto 06:']) !!}
          {!! Form::file('localFoto6', null, ['class' => 'form-control', 'placeholder' => 'Foto:']) !!}
        </div>
        <div class="form-group col-sm-6">
          {!! Form::label('img', 'Imagem 03', ['class' => 'color-blue']) !!}
          {!! Form::textarea('obsFoto3', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Observação foto 03:']) !!}
          {!! Form::file('localFoto3', null, ['class' => 'form-control', 'placeholder' => 'Foto:']) !!}
        </div>
        <div class="form-group col-sm-6">
          {!! Form::label('img', 'Imagem 07', ['class' => 'color-blue']) !!}
          {!! Form::textarea('obsFoto7', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Observação foto 07:']) !!}
          {!! Form::file('localFoto7', null, ['class' => 'form-control', 'placeholder' => 'Foto:']) !!}
        </div>
        <div class="form-group col-sm-6">
          {!! Form::label('img', 'Imagem 04', ['class' => 'color-blue']) !!}
          {!! Form::textarea('obsFoto4', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Observação foto 04:']) !!}
          {!! Form::file('localFoto4', null, ['class' => 'form-control', 'placeholder' => 'Foto:']) !!}
        </div>
        <div class="form-group col-sm-6">
          {!! Form::label('img', 'Imagem 08', ['class' => 'color-blue']) !!}
          {!! Form::textarea('obsFoto8', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Observação foto 08:']) !!}
          {!! Form::file('localFoto8', null, ['class' => 'form-control', 'placeholder' => 'Foto:']) !!}
        </div>

      </div>
    </div>

    <div class="tab-pane fade" id="nav-agendamentos" role="tabpanel" aria-labelledby="nav-agendamentos-tab">
      @if( isset ($clienteEdit[0]->Cod))
      <table class="table table-hover">
        <tr>
          <th>ID</th>
          <th>Nome Paciente</th>
          <th>DT. Consulta</th>
          <th>HR. Consulta</th>
          <th>Medico</th>
          <th>Realizado</th>
          <th>Tipo</th>
          <th width="200px">Ações</th>
        </tr>
        @foreach ($agendamentos as $agendamento)
        <tr>
          <td>{{$agendamento->cod}}</td>
          <td>{{$agendamento->nomePaciente}}</td>
          <td>{{$agendamento->date}}</td>
          <td>{{$agendamento->horario}}</td>
          <td>{{$agendamento->cdProfissional}}</td>
          <td>{{$agendamento->realizado}}</td>
          <td>{{$agendamento->tipo}}</td>
          <td>
            <a href="{{route('agenda.edit', $agendamento->cod)}}" class="actions edit">
              <i class="far fa-edit" style="font-size:20px;"></i>
            </a>
            <a href="{{route('agenda.show', $agendamento->cod)}}" class="actions delete">
              <i class="fas fa-search-plus" style="font-size:20px;"></i>
            </a>
          </td>
        </tr>
        @endforeach
      </table>
      @endif
    </div>

    <div class="tab-pane fade" id="nav-medicamentos" role="tabpanel" aria-labelledby="nav-medicamentos-tab">
      <div class="panel-heading">Listagem de Medicamentos do Paciente</div>
      <div class="form-row align-items-center">
        <div class="form-group col-sm-12">
          <table class="table table-sm">
            <tr>
              <th>ID</th>
              <th>Nome Generico</th>
              <th>Nome de Fabrica</th>
              <th>Posologia</th>
              <th>Administracao</th>
              <th>Concentração</th>
              <th>Quantidade</th>
              <th>Data</th>
              <th>Usuario</th>
              <th>Observações</th>
            </tr>
            @foreach ($medicamentosItens as $medicamentosIten)
            <tr>
              <td>{{$medicamentosIten->codMedicamento}}</td>
              <td>{{$medicamentosIten->nomeGenerico}}</td>
              <td>{{$medicamentosIten->nomeFabrica}}</td>
              <td>{{$medicamentosIten->posologia}}</td>
              <td>{{$medicamentosIten->administracao}}</td>
              <td>{{$medicamentosIten->concentracao}}</td>
              <td>{{$medicamentosIten->qtde}}</td>
              <td>{{$medicamentosIten->data}}</td>
              <td>{{$medicamentosIten->usuario}}</td>
              <td>{{$medicamentosIten->obs}}</td>
            </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>

    <div class="tab-pane fade" id="nav-exames" role="tabpanel" aria-labelledby="nav-exames-tab">
      <div class="panel-heading">Listagem de Exames do Paciente</div>
      <div class="form-row align-items-center">
        <div class="form-group col-sm-12">
          <table class="table table-sm">
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Usuario</th>
              <th>Observações</th>
              <th>Data</th>
            </tr>
            @foreach ($examesItens as $examesIten)
            <tr>
              <td>{{$examesIten->codExame}}</td>
              <td>{{$examesIten->Nome}}</td>
              <td>{{$examesIten->usuario}}</td>
              <td>{{$examesIten->obs}}</td>
              <td>{{$examesIten->data}}</td>
            </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>

  </div>
  {!! Form::close() !!}
  @endsection