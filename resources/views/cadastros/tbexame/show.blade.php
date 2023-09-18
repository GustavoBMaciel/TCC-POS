@extends('layouts.appHome')

@section('content')
<div class="container">

  <div class="panel-heading">Solicitar Exames</div>


  @if( isset ($errors) && count ($errors) > 0 )
  <div class="alert alert-danger">
    @foreach( $errors as $error )
    <p>{{$error}} </p>
    @endforeach
  </div>
  @endif

  @if(isset ($tbexamesEdit))
  @foreach ($tbexamesEdit as $tbexamesEdits)
  @endforeach
  {!! Form::model($tbexamesEdits, ['route' => ['tbexames.update', $tbexamesEdits->Cod ], 'enctype' => 'multipart/form-data', 'method' => 'put']) !!}
  @else
  {!! Form::open(['route' => 'tbexames.tbexamesItens', 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}
  @endif

  <div class="form-row align-items-center">
    @foreach ($tbexamesShow as $tbexamesShows)
    <div class="form-group col-sm-1 my-1" style="display:none">
      {!! Form::text('codExames', $tbexamesShows->cdExames, ['class' => 'form-control', 'id' => 'Valor_Pago', 'placeholder' => 'Valor Pago:']) !!}
    </div>
    @endforeach

    <div class="form-group col-sm-3 ">
      <label style="margin-bottom: -25px;">Paciente</label>
      <select name="codCliente" class="form-control">
        @foreach ($tbexamesShow as $tbexamesShows)
        <option value="{{$tbexamesShows->nome}}">{{$tbexamesShows->nome}}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group col-sm-3">
      <label style="margin-bottom: -25px;">Profissional</label>
      <select name="cdProfissional" class="form-control">
        @foreach ($tbexamesShow as $tbexamesShows)
        <option value="{{$tbexamesShows->medico}}">{{$tbexamesShows->medico}}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group col-sm-3 ">
      <label style="margin-bottom: -25px;">Exames</label>
      <select name="codExame" class="form-control">
        <option value="">Exames</option>
        @foreach ($exames as $exame)
        <option value="{{$exame->Codigo}}">{{$exame->Nome}}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group col-sm-3 ">
      <button style="margin-bottom: -20px;" type="submit" style="text-align: center;" class="btn btn-primary col-sm-12"><i class="far fa-save" style="font-size:20px;"></i> Incluir Exame</button>
    </div>
  </div>
  <div class="form-group">
    <label style="margin-bottom: -25px;">Observação</label>
    {!! Form::textarea('obs', $tbexamesShows->obs, ['class' => 'form-control', 'rows' => '5', 'placeholder' => 'EX: Paciente prefere atendimento após o meio dia']) !!}
  </div>


  <div class="form-row align-items-center">
    <div class="form-group col-sm-12">
      <table class="table table-sm">
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Observações</th>
          <th>Data</th>
        </tr>
        @foreach ($examesItens as $examesIten)
        <tr>
          <td>{{$examesIten->codExame}}</td>
          <td>{{$examesIten->Nome}}</td>
          <td>{{$examesIten->obs}}</td>
          <td>{{$examesIten->data}}</td>
        </tr>
        @endforeach
      </table>
    </div>
  </div>

  <div class="form-row align-items-center">
    <div class="form-group col-sm-4">
      <a href="{{route('exames.pdf', $tbexamesShows->cdExames)}}" style="text-align: center;" class="btn btn-primary col-sm-12"><i class="fas fa-search" style="font-size:20px;"></i> Imprimir</a>
    </div>
    <div class="form-group col-sm-4">
      <a href="{{route('tbexames.index')}}" style="text-align: center;" class="btn btn-danger col-sm-12"><i class="far fa-window-close" style="font-size:20px;"></i> Sair</a>
    </div>
  </div>
</div>

</div>
{!! Form::close() !!}
@endsection