@extends('layouts.appHome')
@section('content')
<div class="container">


  {!! Form::open(['route' => 'permissao.consulta', 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}

  <div class="form-group col-sm-6">
    <label style="margin-bottom: -25px;">Nome Usuario: </label>
    <select name="codfun" class="form-control">
      <option value="">Usuarios</option>
      @foreach ($usuarios as $usuario)
      <option value="{{$usuario->codigo}}">{{$usuario->Usuario}}</option>
      @endforeach
    </select>
  </div>

  {!! Form::submit('Consultar', ['class' => 'btn btn-primary']) !!}

  <a href="{{route('permissao.create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus "></span>Carga de Permissões</a>


    {!! Form::close() !!}
</div>
</div>
@endsection