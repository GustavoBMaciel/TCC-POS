@extends('layouts.appHome')
@section('content')
<div class="container">

  <div class="panel-heading">Solicitar Medicamentos</div>


  @if( isset ($errors) && count ($errors) > 0 )
  <div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">Restrições!</h4>
    @foreach( $errors->all() as $error )
    <p>{{$error}} </p>
    @endforeach
  </div>
  @endif

  @if(isset ($tbmedicamentosEdit))
  @foreach ($tbmedicamentosEdit as $tbmedicamentosEdits)
  @endforeach
  {!! Form::model($tbmedicamentosEdits, ['route' => ['tbmedicamentos.update', $tbmedicamentosEdits->Cod ], 'enctype' => 'multipart/form-data', 'method' => 'put']) !!}
  @else
  {!! Form::open(['route' => 'tbmedicamentos.tbmedicamentosItens', 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}
  @endif

  <div class="form-row align-items-center">
    @foreach ($tbmedicamentosShow as $tbmedicamentosShows)
    <div class="form-group col-sm-1 my-1" style="display:none">
      {!! Form::text('codMedicamentos', $tbmedicamentosShows->cdMedicamentos, ['class' => 'form-control', 'id' => 'Valor_Pago', 'placeholder' => 'Valor Pago:']) !!}
    </div>
    @endforeach

    <div class="form-group col-sm-3 ">
      <label>Paciente</label>
      <select name="codCliente" class="form-control">
        @foreach ($tbmedicamentosShow as $tbmedicamentosShows)
        <option value="{{$tbmedicamentosShows->nome}}">{{$tbmedicamentosShows->nome}}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group col-sm-3">
      <label>Profissional</label>
      <select name="cdProfissional" class="form-control">
        @foreach ($tbmedicamentosShow as $tbmedicamentosShows)
        <option value="{{$tbmedicamentosShows->medico}}">{{$tbmedicamentosShows->medico}}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group col-sm-2" onclick="posologia();">
      <label>Medicamentos</label>
      <select name="codMedicamento" class="form-control">
        <option value="">Medicamentos</option>
        @foreach ($medicamentos as $medicamento)
        <option value="{{$medicamento->codigo}}">{{$medicamento->nomeGenerico}}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group col-sm-1">
      <a style="margin-bottom: -25px;" href="{{route('medicamento.create')}}" class="btn btn-success form-control col-12"><i class="fas fa-plus-square" style="font-size:22px;"></i></a>
    </div>

    <div class="form-group col-sm-1 ">
      <label>Quantidade: </label>
      {!! Form::number('qtde', null, ['class' => 'form-control', 'placeholder' => 'EX: 5']) !!}
    </div>


    <div class="form-group col-sm-2 ">
      <button style="margin-bottom: -25px;" type="submit" style="text-align: center;" class="btn btn-primary col-sm-12"><i class="far fa-save" style="font-size:20px;"></i> Incluir Medicamento</button>
    </div>
  </div>
  <div class="form-group">
    <label>Observação</label>
    {!! Form::textarea('obs', $tbmedicamentosShows->obs, ['class' => 'form-control', 'rows' => '5', 'placeholder' => 'EX: Paciente prefere atendimento após o meio dia']) !!}
  </div>


  <div class="form-row align-items-center">
    <div class="form-group col-sm-12">
      <table class="table table-sm">
        <tr>
          <th>ID</th>
          <th>Nome Generico</th>
          <th>Nome de Fabrica</th>
          <th>Fabricante</th>
          <th>Posologia</th>
          <th>Administracao</th>
          <th>Concentração</th>
          <th>Quantidade</th>
        </tr>
        @foreach ($medicamentosItens as $medicamentosIten)
        <tr>
          <td>{{$medicamentosIten->codMedicamento}}</td>
          <td>{{$medicamentosIten->nomeGenerico}}</td>
          <td>{{$medicamentosIten->nomeFabrica}}</td>
          <td>{{$medicamentosIten->fabricante}}</td>
          <td>{{$medicamentosIten->posologia}}</td>
          <td>{{$medicamentosIten->administracao}}</td>
          <td>{{$medicamentosIten->concentracao}}</td>
          <td>{{$medicamentosIten->qtde}}</td>
        </tr>
        @endforeach
      </table>
    </div>
  </div>

  <div class="form-row align-items-center">
    <div class="form-group col-sm-4">
      <a href="{{route('medicamentos.pdf', $tbmedicamentosShows->cdMedicamentos)}}" style="text-align: center;" class="btn btn-primary col-sm-12"><i class="fas fa-search" style="font-size:20px;"></i> Imprimir</a>
    </div>
    <div class="form-group col-sm-4">
      <a href="{{route('tbmedicamentos.index')}}" style="text-align: center;" class="btn btn-danger col-sm-12"><i class="far fa-window-close" style="font-size:20px;"></i> Sair</a>
    </div>
  </div>
</div>

</div>
{!! Form::close() !!}
@endsection