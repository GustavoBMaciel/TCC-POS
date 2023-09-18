@extends('layouts.appHome')
@section('content')
<div class="container">

  <div class="panel-heading">Listagem de Materiais</div>
  <a href="{{ url('/home') }}" class="btn btn-success btn-add">Voltar</a>
  <a href="{{route('profissao.create')}}" class="btn btn-success btn-add"><span class="glyphicon glyphicon-plus "></span>Cadastrar</a>

  <table class="table table-hover">
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th width="100px">Ações</th>
    </tr>
    @foreach ($profissoes as $profissao)
    <tr>
      <td>{{$profissao->codigo}}</td>
      <td>{{$profissao->nome}}</td>
      <td>
        <a href="{{route('profissao.edit', $profissao->codigo)}}" class="actions edit">
          <span class="glyphicon glyphicon-pencil"></span>
        </a>
        <a href="{{route('profissao.show', $profissao->codigo)}}" class="actions delete">
          <span class="glyphicon glyphicon-eye-open"></span>
        </a>
      </td>
    </tr>
    @endforeach
  </table>
  <hr>
  {!! $profissoes->links() !!}
</div>
</div>
@endsection