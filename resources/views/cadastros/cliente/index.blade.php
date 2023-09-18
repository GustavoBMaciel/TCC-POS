@extends('layouts.appHome')
@section('content')
<div class="container">

  <div class="panel-heading">Listagem de Clientes</div>
  <form class="navbar-form navbar-left" role="search" action="{{route('cliente.pesquisa')}}" method="post">

    <div class="row justify-content-end">
      <div class="col-4">
        {!! csrf_field() !!}
        <input type="text" name="texto" class="form-control" placeholder="Pesquisar por nome. ENTER">
      </div>
    </div>
  </form>

  <table class="table table-hover">
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th >DT. Cadastro</th>
      <th >DT. Nascimento</th>
      <th>Telefone</th>
      <th>Celular</th>
      <th>E-mail</th>
      <th>Status</th>
      <th>Ações</th>
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
        <a href="{{route('cliente.destroy', $cliente->Cod)}}" class="actions delete">
          <i class="far fa-trash-alt" style="font-size:20px;"></i>
        </a>
      </td>
    </tr>
    @endforeach
  </table>
  <hr>
  {!! $clientes->links() !!}

  <button onclick="goBack()" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Voltar</button>
  <a href="{{route('cliente.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Cadastrar</a>


</div>
@endsection

<script>
        function goBack() {
            window.history.back();
        }
    </script>