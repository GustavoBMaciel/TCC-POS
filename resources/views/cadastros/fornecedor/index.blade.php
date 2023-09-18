@extends('layouts.appHome')
@section('content')
<div class="container">

  <div class="panel-heading">Listagem de Fornecedores</div>
  <a href="{{ url('/home') }}" class="btn btn-success btn-add">Voltar</a>
  <a href="{{route('fornecedor.create')}}" class="btn btn-success btn-add"><span class="glyphicon glyphicon-plus "></span>Cadastrar</a>

  <table class="table table-hover">
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Contato</th>
      <th>Telefone</th>
      <th>Data de Cadastro</th>
      <th>Status</th>
      <th>Desconto</th>
      <th>Lança Caixa</th>
      <th width="100px">Ações</th>
    </tr>
    @foreach ($fornecedores as $fornecedor)
    <tr>
      <td>{{$fornecedor->Cod}}</td>
      <td>{{$fornecedor->nome}}</td>
      <td>{{$fornecedor->contato}}</td>
      <td>{{$fornecedor->fone}}</td>
      <td>{{$fornecedor->dtcad}}</td>
      @if($fornecedor->ativo = 1)
      <td>Ativo</td>
      @else
      <td>Inativo</td>
      @endif
      <td>{{$fornecedor->desconto}}</td>
      <td>{{$fornecedor->lancaCaixa}}</td>
      <td>
        <a href="{{route('fornecedor.edit', $fornecedor->cod)}}" class="actions edit">
          <i class="far fa-edit" style="font-size:20px;"></i>
        </a>
        {!! Form::open(['route' => ['fornecedor.destroy', $fornecedor->Cod], 'method' => 'DELETE']) !!}
        {!! Form::submit("Deletar fornecedor: $fornecedor->nome", ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
      </td>
    </tr>
    @endforeach
  </table>
  <hr>
  {!! $fornecedores->links() !!}
</div>
</div>
@endsection