@extends('layouts.appHome')

@section('content')
<div class="container">

  <div class="panel-heading">Anamnese</div>


  @if( isset ($errors) && count ($errors) > 0 )
  <div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Restrições!</h4>
    @foreach( $errors->all() as $error )
    <p>{{$error}} </p>
    @endforeach
  </div>
  @endif

  @if(isset ($anamneseEdit))
  @foreach ($anamneseEdit as $anamneseEdits)
  @endforeach
  {!! Form::model($anamneseEdits, ['route' => ['anamnese.update', $anamneseEdits->cdCodigo ], 'enctype' => 'multipart/form-data', 'method' => 'put']) !!}
  @else
  {!! Form::open(['route' => 'anamnese.store', 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}
  @endif

  <div class="form-row align-items-center">

    <div class="form-group col-sm-4 ">
      <label style="margin-bottom: -25px;">Paciente</label>
      <select name="CodigoPaciente" class="form-control">
        @if( !isset ($anamneseEdits->cdCodigo))
        <option value="0">Paciente</option>
        @else
        <option value="{{$anamneseEdits->cdCodigo}}">{{$anamneseEdits->nome}}</option>
        @endif
        @foreach ($clientes as $cliente)
        <option value="{{$cliente->Cod}}">{{$cliente->nome}}</option>
        @endforeach
      </select>
    </div>


    <div class="form-group col-sm-4 my-1">
      <label style="margin-bottom: -25px;">Data da 1º Primeira Consulta</label>
      <div class="form-group">
        {!! Form::date('data', null, ['class' => 'form-control']) !!}
      </div>
    </div>

    <div class="form-group col-sm-4">
      <label style="margin-bottom: -25px;">Profissional</label>
      <select name="cdProfissional" class="form-control">
        @if( !isset ($anamneseEdits->cdCodigo))
        <option value="0">Profissional</option>
        @else
        <option value="{{$anamneseEdits->cdCodigo}}">{{$anamneseEdits->medico}}</option>
        @endif
        @foreach ($profissoes as $profissao)
        <option value="{{$profissao->cdProfissional}}">{{$profissao->dsNomeMedico}}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="form-group">
    {!! Form::textarea('Questionario', null, ['class' => 'form-control', 'rows' => '25', 'placeholder' => 'Descrição:']) !!}
  </div>
  <div class="form-row align-items-center">
    <div class="form-group col-sm-2">
      <button type="submit" style="text-align: center;" class="btn btn-primary col-sm-12"><i class="far fa-save" style="font-size:20px;"></i> Salvar</button>
    </div>
    <div class="form-group col-sm-2">
      @if( !isset ($anamneseEdits->cdCodigo))
      <a href="#" style="text-align: center;" class="btn btn-secondary dropdown-item disabled"><i class="fas fa-print" style="font-size:20px;"></i> Imprimir Anamnese</a>
      @else
      <a href="{{route('anamnese.pdf', $anamneseEdits->cdCodigo)}}" style="text-align: center;" class="btn btn-primary col-sm-12"><i class="fas fa-printl" style="font-size:20px;"></i> Imprimir Anamnese</a>
      @endif
    </div>
  </div>

</div>
{!! Form::close() !!}
@endsection