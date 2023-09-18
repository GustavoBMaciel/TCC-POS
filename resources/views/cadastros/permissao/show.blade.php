@extends('layouts.appHome')
@section('content')

<div class="container">


  <!-- Three columns -->
  {!! Form::open(['route' => 'permissao.store', 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}

 
  <div class="form-row align-items-center">
  <div class="form-group col-sm-6">
    <label style="margin-bottom: -25px;">Nome Paciente: </label>
    <select name="codfun" class="form-control">
      @if( !isset ($nomeCli->Usuario))
      <option value="0">Usuarios</option>
      @else
      <option value="{{$nomeCli->codigo}}">{{$nomeCli->Usuario}}</option>
      @endif
      @foreach ($usuarios as $usuario)
      <option value="{{$usuario->codigo}}">{{$usuario->Usuario}}</option>
      @endforeach
    </select>
    </div>
    <div class="form-group col-sm-3 my-1">
    <button type="submit" style="text-align: center;" class="btn btn-primary col-sm-12"><i class="far fa-save" style="margin-bottom: -25px;"></i> Salvar</button>
    </div>
  </div>


<?php foreach($permissaosG as $permissaosGs){ ?>

  <div class="form-group col-sm-6">
    <div class="checkbox">

      <label for="<?php echo $permissaosGs['grupo'] ?>" class="form-check-label">

        <input type="checkbox" id="<?php echo $permissaosGs['codigo'] ?>"
        name="permissões[]" value="<?php echo $permissaosGs['codigo'] ?>"
        class="form-check-input"

        <?php foreach($permissaoCli as $permissaoClis){
            if($permissaoClis->codigopermissao == $permissaosGs['codigo']){
            ?> checked <?php }} ?>>

        <?php echo $permissaosGs['descricaotela'];?>

      </label>

    </div>
    </div>

<?php } ?>



</div>
{!! Form::close() !!}
@endsection