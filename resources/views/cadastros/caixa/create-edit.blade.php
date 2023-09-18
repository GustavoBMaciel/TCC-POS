@extends('layouts.appHome')
@section('content')
<div class="container">

  <div class="panel-heading">Caixa</div>

  @if( isset ($errors) && count ($errors) > 0 )
  <div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Restrições!</h4>
    @foreach( $errors->all() as $error )
    <p>{{$error}} </p>
    @endforeach
  </div>
  @endif

  @if(isset ($caixaEdit))
  @foreach ($caixaEdit as $caixaEdits)
  @endforeach
  {!! Form::model($caixaEdits, ['route' => ['caixa.update', $caixaEdits->Cod ], 'enctype' => 'multipart/form-data', 'method' => 'put']) !!}
  @else
  {!! Form::open(['route' => 'caixa.pesquisa', 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}
  @endif

  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-item nav-link active" id="nav-dadosPessoais-tab" data-toggle="tab" href="#nav-dadosPessoais" role="tab" aria-controls="nav-dadosPessoais" aria-selected="true">Convênios</a>
  </nav>

  <div class="panel-heading">Consultar</div>
  <div class="tab-content" id="nav-tabContent">
    <div class="form-row align-items-center">
      <div class="form-group col-sm-3">
        <label>Filtro Profissional: </label>
        <select name="filtroProfissional" class="form-control">
          <option value="">Profissional</option>
          @foreach ($profissoes as $profissao)
          <option value="{{$profissao->cdProfissional}}">{{$profissao->dsNomeMedico}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-sm-3  my-1">
        <div class="form-group">
          <label>Filtro Data Inicio: </label>
          {!! Form::date('filtroDataInicio', null, ['class' => 'form-control']) !!}
        </div>
      </div>
      <div class="form-group col-sm-3  my-1">
        <div class="form-group">
          <label>Filtro Data Final: </label>
          {!! Form::date('filtroDataFim', null, ['class' => 'form-control']) !!}
        </div>
      </div>
      <div class="form-group col-sm-3 my-1">
        <button style="margin-bottom: -15px;" type="submit" style="text-align: center;" class="btn btn-primary col-sm-12"><i class="far fa-save" style="font-size:20px;"></i> Consultar</button>
      </div>
    </div>
  </div>
  {!! Form::close() !!}

  {!! Form::open(['route' => 'caixa.store', 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}

  <hr>

  <div class="panel-heading">Lançamento</div>

  <div class="tab-content" id="nav-tabContent">

    <div class="form-row align-items-center">
      <div class="form-group col-sm-4">
        <label>Profissional: </label>
        <select name="cdProfissional" class="form-control">
          <option value="">Profissional</option>
          @foreach ($profissoes as $profissao)
          <option value="{{$profissao->cdProfissional}}">{{$profissao->dsNomeMedico}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-sm-4 ">
        <label>Nome Paciente: </label>
        <select name="Nome_Clifor" class="form-control">
          <option value="">Paciente</option>
          @foreach ($clientes as $cliente)
          <option value="{{$cliente->nome}}">{{$cliente->nome}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-sm-4  my-1">
        <label>Data Inicio: </label>
        <div class="form-group">
          {!! Form::date('Data', null, ['class' => 'form-control']) !!}
        </div>
      </div>
    </div>
      <div class="form-row align-items-center">
      <div class="form-group col-sm-1 ">
        <label>Tipo: </label>
        {!! Form::text('Tipo', null, ['class' => 'form-control', 'id' => 'tipo', 'placeholder' => 'EX: C']) !!}
      </div>
      <div class="form-group col-sm-4 " onclick="toTipo();">
        <label>Valor Crédito: </label>
        {!! Form::number('Valor', null, ['class' => 'form-control', 'id' => 'c', 'placeholder' => 'Céditos:']) !!}
      </div>
      <div class="form-group col-sm-4" onclick="toTipo();">
        <label>Valor Débitos: </label>
        {!! Form::number('Valor', null, ['class' => 'form-control', 'id' => 'd', 'placeholder' => 'Débitos:']) !!}
      </div>
      <div class="form-group col-sm-3 my-1">
        <button style="margin-bottom: -15px;" type="submit" style="text-align: center;" class="btn btn-primary col-sm-12"><i class="far fa-save" style="font-size:20px;"></i> Salvar</button>
      </div>
    </div>


    <div class="form-row align-items-center">
      <div class="form-group col-sm-12">
        <table class="table table-sm">
          <tr>
            <th>ID</th>
            <th>Data</th>
            <th>Nome Paciente</th>
            <th>CPF</th>
            <th>Crédito/Débito</th>
            <th>Valor R$</th>
            <th>Profissional</th>
            <th>Ações</th>
          </tr>
          @foreach ($caixas as $caixa)
          <tr>
            <td>{{$caixa->Num_Sequencial}}</td>
            <td>{{$caixa->Data}}</td>
            <td>{{$caixa->Nome_Clifor}}</td>
            <td>{{$caixa->dsCPF}}</td>
            <td>{{$caixa->Tipo}}</td>
            <td>{{$caixa->Valor}}</td>
            <td>{{$caixa->dsNomeMedico}}</td>
            <td>
              <a href="{{route('caixa.destroy', $caixa->Num_Sequencial)}}" class="actions delete">
                <i class="far fa-trash-alt" style="font-size:20px;"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </table>
        <div class="row justify-content-end">
          <label>Total R$: {{$total}} </label>
        </div>
      </div>
    </div>

    <div class="row justify-content-end">
      <div class="form-group col-sm-4">
        <a href="{{route('home')}}" style="text-align: center;" class="btn btn-danger col-sm-12"><i class="far fa-window-close" style="font-size:20px;"></i> Sair</a>
      </div>
    </div>
  </div>

</div>
{!! Form::close() !!}
@endsection

<script>
  function toTipo() {

    var tipoValue = document.getElementById("tipo").value

    if (tipoValue == "C") {
      document.getElementById("d").disabled = true;
      document.getElementById("c").disabled = false;
    } else if (tipoValue == "D") {
      document.getElementById("c").disabled = true;
      document.getElementById("d").disabled = false;
    } else
      alert("Tipo deve ser 'C' ou 'D'");
  }
</script>