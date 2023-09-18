@extends('layouts.appHome')
@section('content')
<div class="container">


  <!-- Three columns -->
  <a href="{{route('cid10.create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus "></span>Carga de CID10</a>

  {!! Form::open(['route' => 'cid10.store', 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}
  <div class="form-row align-items-center">
    <div class="form-group col-sm-4">
      <select name="categoria" class="form-control">
        <option value="">Categorias</option>
        @foreach ($cid10sCAT as $cid10sCATS)
        <option value="{{$cid10sCATS->CID10}}">{{$cid10sCATS->DESCR}}</option>
        @endforeach
      </select>
    </div>


  {!! Form::submit('Consultar', ['class' => 'btn btn-primary']) !!}
  {!! Form::close() !!}
  </div>
  <table class="table table-hover">
    <tr>
      <th>ID</th>
      <th>Descrição</th>
    </tr>
    @foreach ($cid10Show as $cid10ShowS)
    <tr>
      <td>{{$cid10ShowS->CID10}}</td>
      <td>{{$cid10ShowS->DESCR}}</td>
    </tr>
    @endforeach
  </table>
</div>
@endsection