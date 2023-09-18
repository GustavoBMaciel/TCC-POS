@extends('layouts.appHome')

@section('content')


<div class="container">

<div class="panel-heading">Agendamentos do Dia</div>

  @if (\Session::has('message'))
  <div class="alert alert-success">
    <ul>
      <li>{!! \Session::get('message') !!}</li>
    </ul>
  </div>
  @endif

  <div class="form-group col-sm-12">
        <table class="table table-sm">
          <tr>
            <th>Nome do Paciente</th>
            <th>Convênio</th>
            <th>Tipo</th>
            <th>Data</th>
            <th>Hora</th>
            <th>Status</th>
            <th>Medico</th>
          </tr>
          @foreach ($agendas as $agenda)
          <tr>
            <td>{{$agenda->nomePaciente}}</td>
            <td>{{$agenda->nomeConvenio}}</td>
            <td>{{$agenda->tipoNome}}</td>
            <td>{{$agenda->data}}</td>
            <td>{{$agenda->horario}}</td>
            <td>{{$agenda->realizado}} - {{$agenda->nome}}</td>
            <td>{{$agenda->dsNomeMedico}}</td>
          </tr>
          @endforeach
        </table>
      </div>
</div>
@endsection