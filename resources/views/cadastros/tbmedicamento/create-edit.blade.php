@extends('layouts.appHome')

@section('content')
<div class="container">

  <div class="panel-heading">{{$tbmedicamentosEdit->nome or 'Novo'}}</div>


  @if( isset ($errors) && count ($errors) > 0 )
  <div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Restrições!</h4>
    @foreach( $errors->all() as $error )
    <p>{{$error}} </p>
    @endforeach
  </div>
  @endif

  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-item nav-link active" id="nav-dadosPessoais-tab" data-toggle="tab" href="#nav-dadosPessoais" role="tab" aria-controls="nav-dadosPessoais" aria-selected="true">Medicamentos</a>
      <a class="nav-item nav-link" id="nav-dadosAnamnese-tab" data-toggle="tab" href="#nav-dadosAnamnese" role="tab" aria-controls="nav-dadosAnamnese" aria-selected="false">Consultar</a>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-dadosPessoais" role="tabpanel" aria-labelledby="nav-dadosPessoais-tab">

      @if(isset ($tbmedicamentosEdit))
      @foreach ($tbmedicamentosEdit as $tbmedicamentosEdit)
      @endforeach
      {!! Form::model($tbmedicamentosEdit, ['route' => ['tbmedicamentos.update', $tbmedicamentosEdit->cdMedicamentos ], 'enctype' => 'multipart/form-data', 'class' => 'form', 'method' => 'put']) !!}
      @else
      {!! Form::open(['route' => 'tbmedicamentos.store', 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}
      @endif

      <div class="form-row align-items-center">

        <div class="form-group col-sm-3 ">
          <label style="margin-bottom: -25px;">Paciente</label>
          <select name="codCliente" class="form-control">
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

        <div class="form-group col-sm-3">
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

      <div class="form-row align-items-center">
        <div class="form-group col-sm-6">
          <button type="submit" style="text-align: center;" class="btn btn-primary col-sm-12"><i class="far fa-save" style="font-size:20px;"></i> Solicitar Medicamentos</button>
        </div>

        <div class="form-group col-sm-6">
          <a href="{{route('cliente.index')}}" style="text-align: center;" class="btn btn-danger col-sm-12"><i class="far fa-window-close" style="font-size:20px;"></i> Sair</a>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
    <div class="tab-pane fade" id="nav-dadosAnamnese" role="tabpanel" aria-labelledby="nav-dadosAnamnese-tab">
      <div class="container">
        <table class="table table-hover">
          <tr>
            <th>ID</th>
            <th>Nome Paciente</th>
            <th>Nome Medico</th>
            <th>Data</th>
          </tr>
          @foreach ($medicamentos as $medicamento)
          <tr>
            <td>{{$medicamento->cdMedicamentos}}</td>
            <td>{{$medicamento->nome}}</td>
            <td>{{$medicamento->medico}}</td>
            <td>{{$medicamento->data}}</td>
          </tr>
          @endforeach
        </table>
        <hr>
        {!! $tbmedicamentos->links() !!}
      </div>
    </div>
  </div>
  @endsection