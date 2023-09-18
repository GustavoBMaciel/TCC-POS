@extends('layouts.appHome')

@section('content')
<div class="container">

  <div class="panel-heading">Consulta:</div>

  @if( isset ($errors) && count ($errors) > 0 )
  <div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Restrições!</h4>
    @if(session('errors'))
    {{session('errors')}}
    @endif
  </div>
  @endif

  {!! Form::open(['route' => 'agenda.pesquisa', 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}

  <div class="tab-content" id="nav-tabContent">

    <div class="form-row align-items-center">
      <div class="form-group col-sm-4">
        <label style="margin-bottom: -25px;">Filtro por Status: </label>
        <select name="filtroStatus" class="form-control">
          <option value="">Status</option>
          @foreach ($status as $statuss)
          <option value="{{$statuss->dsSimbolo}}">{{$statuss->nome}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-sm-3">
        <label style="margin-bottom: -25px;">Filtro por Profissional: </label>
        <select name="filtroProfissional" class="form-control">
          <option value="">Profissional</option>
          @foreach ($profissoes as $profissao)
          <option value="{{$profissao->cdProfissional}}">{{$profissao->dsNomeMedico}}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group col-sm-3 my-1">
        <label style="margin-bottom: -25px;">Filtro por Data: </label>
        <div class="form-group">
          {!! Form::date('filtroData', null, ['class' => 'form-control']) !!}
        </div>
      </div>

      <div class="form-group col-sm-2 my-1">
        <button type="submit" style="text-align: center;" class="btn btn-primary col-sm-12"><i class="fas fa-search" style="font-size:20px; "></i> Consultar</button>
      </div>
    </div>
    {!! Form::close() !!}

    @if(isset ($agendaEdit))
    @foreach ($agendaEdit as $agendaEdits)
    @endforeach
    {!! Form::model($agendaEdits, ['route' => ['agenda.update', $agendaEdits->cod ], 'enctype' => 'multipart/form-data', 'method' => 'put']) !!}
    @else
    {!! Form::open(['route' => 'agenda.store', 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}
    @endif

    <div class="form-row align-items-center">
      <div class="form-group col-sm-3">
        <label style="margin-bottom: -25px;">Nome Paciente: </label>
        <select name="nomePaciente" class="form-control">
          @if( !isset ($agendaEdit[0]->cod))
          <option value="">Paciente</option>
          @else
          @foreach ($agendaEdit as $agendaEdits)
          <option value="{{$agendaEdits->nomePaciente}}">{{$agendaEdits->nomePaciente}}</option>
          @endforeach
          @endif
          @foreach ($clientes as $cliente)
          <option value="{{$cliente->nome}}">{{$cliente->nome}}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group col-sm-9">
        <table class="table table-sm">
          <tr>
            <th>Nome do Paciente</th>
            <th>Convênio</th>
            <th>Tipo</th>
            <th>Data</th>
            <th>Hora</th>
            <th>Status</th>
            <th>Medico</th>
            <th>Opções</th>
          </tr>
          @foreach ($agendas as $agenda)
          <tr>
            <td>{{$agenda->nomePaciente}}</td>
            <td>{{$agenda->nomeConvenio}}</td>
            <td>{{$agenda->tipoNome}}</td>
            <td>{{$agenda->data}}</td>
            <td>{{$agenda->horario}}</td>
            <td style="color:{{$agenda->dsCor}} ">{{$agenda->realizado}} - {{$agenda->nome}}</td>
            <td>{{$agenda->dsNomeMedico}}</td>
            <td>
              <a href="{{route('agenda.edit', $agenda->cod)}}" class="actions edit">
                <i class="far fa-edit" style="font-size:20px;"></i>
              </a>
              <a href="{{route('agenda.destroy', $agenda->cod)}}" class="actions delete">
                <i class="far fa-trash-alt" style="font-size:20px;"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>

    <div class="form-row align-items-center">
      <div class="form-group col-sm-3">
        <label style="margin-bottom: -25px;">Profissional: </label>
        <select name="cdProfissional" class="form-control">
          @if( !isset ($agendaEdit[0]->cod))
          <option value="0">Profissional</option>
          @else
          @foreach ($agendaEdit as $agendaEdits)
          <option value="{{$agendaEdits->cdProfissional}}">{{$agendaEdits->dsNomeMedico}}</option>
          @endforeach
          @endif
          @foreach ($profissoes as $profissao)
          <option value="{{$profissao->cdProfissional}}">{{$profissao->dsNomeMedico}}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-row align-items-center">
      <div class="form-group col-sm-3">
        <label style="margin-bottom: -25px;">Data da Consulta: </label>
        <div class="form-group">
          {!! Form::date('data', null, ['class' => 'form-control']) !!}
        </div>
      </div>
    </div>

    <div class="form-row align-items-center">
      <div class="form-group col-sm-3">
        <label style="margin-bottom: -25px;">Horario da Consulta: </label>
        <div class="form-group">
          {!! Form::time('horario', null, ['class' => 'form-control']) !!}
        </div>
      </div>
    </div>

    <div class="form-row align-items-center">
      <div class="form-group col-sm-3">
        <label style="margin-bottom: -25px;">Telefone Paciente: </label>
        {!! Form::text('fonePaciente', null, ['class' => 'form-control', 'placeholder' => 'EX: DD00000000']) !!}
      </div>
    </div>

    <div class="form-row align-items-center">
      <div class="form-group col-sm-2">
        <label style="margin-bottom: -25px;">Tipo da Consulta: </label>
        <select name="tipo" class="form-control">
          @if( !isset ($agendaEdit[0]->cod))
          <option value="0">Tipo</option>
          @else
          @foreach ($agendaEdit as $agendaEdits)
          <option value="{{$agendaEdits->tipo}}">{{$agendaEdits->tipoNome}}</option>
          @endforeach
          @endif
          @foreach ($tipos as $tipo)
          <option value="{{$tipo->cdTipoAgendamento}}">{{$tipo->nome}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-sm-1 my-1">
        <a href="{{route('tbtipoagendamento.create')}}" class="btn btn-success form-control col-12"><i class="fas fa-plus-square" style="font-size:22px;"></i></a>
      </div>
    </div>
    <div class="form-row align-items-center">
      <div class="form-group col-sm-2">
        <label style="margin-bottom: -25px;">Status Consulta: </label>
        <select name="Status" class="form-control">
          @if( !isset ($agendaEdit[0]->cod))
          <option value="0">Status</option>
          @else
          @foreach ($agendaEdit as $agendaEdits)
          <option value="{{$agendaEdits->realizado}}">{{$agendaEdits->nome}}</option>
          @endforeach
          @endif
          @foreach ($status as $statuss)
          <option value="{{$statuss->dsSimbolo}}">{{$statuss->nome}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-sm-1 my-1">
        <a href="{{route('tbstatusagenda.create')}}" class="btn btn-success form-control col-12"><i class="fas fa-plus-square" style="font-size:22px;"></i></a>
      </div>
    </div>

    <div class="form-row align-items-center">
      <div class="form-group col-sm-3">
        <label style="margin-bottom: -25px;">Convenio: </label>
        <select name="nomeConvenio" class="form-control">
          @if( !isset ($agendaEdit[0]->cod))
          <option value="0">Convênio</option>
          @else
          @foreach ($agendaEdit as $agendaEdits)
          <option value="{{$agendaEdits->nomeConvenio}}">{{$agendaEdits->nomeConvenio}}</option>
          @endforeach
          @endif
          @foreach ($convenios as $convenio)
          <option value="{{$convenio->nome}}">{{$convenio->nome}}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-row align-items-center">
      <div class="form-group col-sm-3">
        <button type="submit" style="text-align: center;" class="btn btn-primary col-sm-12"><i class="far fa-save" style="font-size:20px;"></i> Salvar</button>
      </div>
    </div>

    <div class="form-row align-items-center">
      <div class="form-group col-sm-6">
        <a href="{{route('cliente.create')}}" style="text-align: center;" class="btn btn-primary col-sm-12"><i class="fas fa-print" style="font-size:20px;"></i> Cad.Paciente</a>
      </div>
      <div class="form-group col-sm-6">
        <a href="{{route('home')}}" style="text-align: center;" class="btn btn-danger col-sm-12"><i class="far fa-window-close" style="font-size:20px;"></i> Sair</a>
      </div>
    </div>
  </div>
</div>
{!! Form::close() !!}
@endsection