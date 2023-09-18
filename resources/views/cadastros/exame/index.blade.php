@extends('layouts.appHome')
@section('content')
<div class="container">

  <div class="panel-heading">Listagem de Materiais</div>
  <a href="{{ url('/home') }}" class="btn btn-success btn-add">Voltar</a>
  <a href="{{route('tipo.create')}}" class="btn btn-success btn-add"><span class="glyphicon glyphicon-plus "></span>Cadastrar</a>

  <table class="table table-hover">
    <tr>
      <th>Nome</th>
      <th width="100px">Ações</th>
    </tr>
    @foreach ($tipos as $tipo)
    <tr>
      <td>{{$tipo->nome}}</td>
      <td>
        <a href="{{route('tipo.edit', $tipo->nome)}}" class="actions edit">
          <span class="glyphicon glyphicon-pencil"></span>
        </a>
        <a href="{{route('tipo.show', $tipo->nome)}}" class="actions delete">
          <span class="glyphicon glyphicon-eye-open"></span>
        </a>
      </td>
    </tr>
    @endforeach
  </table>
  <hr>
  {!! $tipos->links() !!}
</div>
</div>
@endsection