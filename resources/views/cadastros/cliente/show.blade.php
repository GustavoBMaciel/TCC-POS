@extends('layouts.appHome')

@section('content')
<div class="container">

  <div class="panel-heading">{{$title}}</div>


  @if( isset ($errors) && count ($errors) > 0 )
  <div class="alert alert-danger">
    @foreach( $errors as $error )
    <p>{{$error}} </p>
    @endforeach
  </div>
  @endif

  {!! Form::open(['route' => 'cliente.agendaProxConsulta', 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}

  <div class="tab-content" id="nav-tabContent">
    <div class="form-row align-items-center">
      <div class="form-group col-sm-2 my-1">
        <select name="cdProfissional" class="form-control">
          <option value="">Profissional</option>
          @foreach ($profissional as $profissionals)
          <option value="{{$profissionals->cdProfissional}}">{{$profissionals->dsNomeMedico}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-sm-3 my-1">
        <select name="codcli" class="form-control">
          @foreach ($clienteShow as $clienteShows)
          <option value="{{$clienteShows->Cod}}">{{$clienteShows->nome}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-sm-2 my-1">
        <select name="tipo" class="form-control">
          <option value="">Tipo</option>
          @foreach ($tipos as $tipo)
          <option value="{{$tipo->cdTipoAgendamento}}">{{$tipo->nome}}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group col-sm-1">
          <a style="margin-bottom: -15px;" href="{{route('tbtipoagendamento.create')}}" class="btn btn-success form-control col-12"><i class="fas fa-plus-square" style="font-size:22px;"></i></a>
        </div>

      <div class="form-group col-sm-2">
        <label>Data</label>
        <div class="form-group">
          {!! Form::date('data', null, ['class' => 'form-control']) !!}
        </div>
      </div>

      <div class="form-group col-sm-2">
        <label>Horário</label>
        <div class="form-group">
          {!! Form::time('horario', null, ['class' => 'form-control']) !!}
        </div>
      </div>
    </div>
  </div>

  <div class="form-row align-items-center">
    <div class="form-group col-sm-2 my-1">
      <button type="submit" style="text-align: center;" class="btn btn-primary col-sm-12"><i class="far fa-save" style="font-size:20px;"></i> Salvar</button>
    </div>
  </div>
</div>
{!! Form::close() !!}
@endsection