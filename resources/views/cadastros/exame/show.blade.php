@extends('layouts.appHome')
@section('content')

<div class="container">

  <div class="panel-heading">{{$produtoShow->nome}}</div>

  <table  class="table table-striped">
    <p><b>ID:</b> {{$produtoShow->id}}</p>
    <p><b>Descrição:</b> {{$produtoShow->descricao}}</p>
    <p><b>Quantidade:</b> {{$produtoShow->quantidade}}</p>
    <p><b>Categoria:</b> {{$produtoShow->categoria}}</p>
    <p><b>Status:</b> {{$produtoShow->ativo}}</p>
    <p><b>Imagem: </b>
<p></p>
      <img width="500px" src="{{ url('/assests/painel/imgs/', $produtoShow->imagem )}}" alt=""></p>

  </table>
  <a href="{{route('produtos.index')}}" class="btn btn-success">Voltar</a>

  <hr>
  @if( isset ($errors) && count ($errors) > 0 )
  <div class="alert alert-danger">
    @foreach( $errors->all() as $error )
    <p>{{$error}} </p>
    @endforeach
  </div>
  @endif

  {!! Form::open(['route' => ['produtos.destroy', $produtoShow->id], 'method' => 'DELETE']) !!}
  {!! Form::submit("Deletar Material: $produtoShow->nome", ['class' => 'btn btn-danger']) !!}
  {!! Form::close() !!}
</div>
@endsection
