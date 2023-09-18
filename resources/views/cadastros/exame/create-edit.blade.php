@extends('layouts.appHome')
@section('content')
<div class="container">

  <div class="panel-heading">Listagem de Exames</div>
  <a href="{{route('exame.index')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus "></span>Carga de Exames</a>

  <form class="navbar-form navbar-left" role="search" action="{{route('exame.pesquisa')}}" method="post">

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
    </tr>
    @foreach ($exames as $exame)
    <tr>
      <td>{{$exame->Codigo}}</td>
      <td>{{$exame->Nome}}</td>
    </tr>
    @endforeach
  </table>
  <hr>
  {!! $exames->links() !!}

  <button onclick="goBack()" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Voltar</button>
</div>
@endsection

<script>
        function goBack() {
            window.history.back();
        }
    </script>