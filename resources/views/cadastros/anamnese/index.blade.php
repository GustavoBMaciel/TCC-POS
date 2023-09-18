@extends('layouts.appHome')
@section('content')
<div class="container">

      <div class="panel-heading">Listagem de Clientes</div>
      <a href="{{ url('/home') }}" class="btn btn-success btn-add">Voltar</a>
      <a href="{{route('cliente.create')}}" class="btn btn-success btn-add"><span class="glyphicon glyphicon-plus "></span>Cadastrar</a>

      <table  class="table table-hover">
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th width="500px">DT. Cadastro</th>
          <th width="500px">DT. Nascimento</th>
          <th>Telefone</th>
          <th>Celular</th>
          <th>E-mail</th>
          <th>Status</th>
          <th width="200px">Ações</th>
        </tr>
        @foreach ($clientes as $cliente)
        <tr>
          <td>{{$cliente->Cod}}</td>
          <td>{{$cliente->nome}}</td>
          <td>{{$cliente->dtcad}}</td>
          <td>{{$cliente->dtnasc}}</td>
          <td>{{$cliente->fone}}</td>
          <td>{{$cliente->celular}}</td>
          <td>{{$cliente->dsEmail}}</td>
          @if($cliente->ativo == 1)
          <td>Ativo</td>
          @else
          <td>Inativo</td>
          @endif
          <td>
            <a href="{{route('cliente.edit', $cliente->Cod)}}" class="actions edit">
            <i class="far fa-edit" style="font-size:20px;"></i>
            </a>
            <a href="{{route('cliente.show', $cliente->Cod)}}" class="actions delete">
            <i class="fas fa-search-plus" style="font-size:20px;"></i>
            </a>
          </td>
        </tr>
        @endforeach
      </table>
      <hr>
      {!! $anamneses->links() !!}
    </div>
  </div>
  @endsection
