@extends('layouts.appHome')

@section('content')
<div class="container">

  <div class="panel-heading">Contas a Receber</div>

  @if( isset ($errors) && count ($errors) > 0 )
  <div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Restrições!</h4>
    @foreach( $errors->all() as $error )
    <p>{{$error}} </p>
    @endforeach
  </div>
  @endif

  @if(isset ($conpagEdit))
  @foreach ($conpagEdit as $conpagEdits)
  @endforeach
  {!! Form::model($conpagEdits, ['route' => ['conpag.update', $conpagEdits->Cod ], 'enctype' => 'multipart/form-data', 'method' => 'put']) !!}
  @else
  {!! Form::open(['route' => 'conpag.pesquisa', 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}
  @endif
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
      <div class="form-group col-sm-3 my-1">
        <label>Data</label>
        <div class="form-group">
          {!! Form::date('filtroDataInicio', null, ['class' => 'form-control']) !!}
        </div>
      </div>
      <div class="form-group col-sm-3 my-1">
        <label>Data</label>
        <div class="form-group">
          {!! Form::date('filtroDataFim', null, ['class' => 'form-control']) !!}
        </div>
      </div>
      <div class="form-group col-sm-3">
        <button style="margin-bottom: -25px;" type="submit" style="text-align: center;" class="btn btn-primary col-sm-12"><i class="far fa-save" style="font-size:20px;"></i> Consultar</button>
      </div>
    </div>
  </div>
  {!! Form::close() !!}

  {!! Form::open(['route' => 'conpag.store', 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}

  <hr>

  <div class="panel-heading">Lançamento</div>
  <div class="tab-content" id="nav-tabContent">
    <div class="form-row align-items-center">
      <div class="form-group col-sm-5">
        <label>Profissional: </label>
        <select name="cdProfissional" class="form-control">
          <option value="">Profissional</option>
          @foreach ($profissoes as $profissao)
          <option value="{{$profissao->cdProfissional}}">{{$profissao->dsNomeMedico}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-sm-1">
        <a style="margin-bottom: -28px;" href="{{route('profissional.create')}}" class="btn btn-success form-control col-12"><i class="fas fa-plus-square" style="font-size:22px;"></i></a>
      </div>
      <div class="form-group col-sm-5">
        <label>Fornecedor</label>
        <select name="CODFOR" class="form-control">
          <option value="">Fornecedor</option>
          @foreach ($fornecedores as $fornecedore)
          <option value="{{$fornecedore->cod}}">{{$fornecedore->nome}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-sm-1">
        <a style="margin-bottom: -28px;" href="{{route('fornecedor.create')}}" class="btn btn-success form-control col-12"><i class="fas fa-plus-square" style="font-size:22px;"></i></a>
      </div>
    </div>
    <div class="form-row align-items-center">
      <div class="form-group col-sm-4 my-1">
        <label>Data de Lançamento</label>
        <div class="form-group">
          {!! Form::date('DATA', null, ['class' => 'form-control', 'id' => 'DATA']) !!}
        </div>
      </div>
      <div class="form-group col-sm-3 my-1" style="display:none">
        <label>Data de Pagamento</label>
        <div class="form-group">
          {!! Form::date('DTPAG', null, ['class' => 'form-control' , 'id' => 'DTPAG']) !!}
        </div>
      </div>
      <div class="form-group col-sm-3 my-1">
        <label>Data de Vencimento</label>
        <div class="form-group">
          {!! Form::date('DTVENC', null, ['class' => 'form-control']) !!}
        </div>
      </div>
      <div class="form-group col-sm-1 ">
        <label>Pago</label>
        {!! Form::text('PAGO', null, ['class' => 'form-control', 'id' => 'PAGO', 'placeholder' => 'EX: S/N']) !!}
      </div>
      <div class="form-group col-sm-2 " style="display:none">
        {!! Form::number('Valor_Pago', null, ['class' => 'form-control', 'id' => 'Valor_Pago', 'placeholder' => 'Valor Pago:']) !!}
      </div>
      <div class="form-group col-sm-2 ">
        <label>Valor R$</label>
        {!! Form::number('VALOR', null, ['class' => 'form-control', 'id' => 'Valor', 'placeholder' => 'EX: 5']) !!}
      </div>
      <div class="form-group col-sm-2 " onclick="toVlPago();">
        <button style="margin-bottom: -25px;" type="submit" style="text-align: center;" class="btn btn-primary col-sm-12"><i class="far fa-save" style="font-size:20px;"></i> Salvar</button>
      </div>
    </div>


    <div class="form-row align-items-center">
      <div class="form-group col-sm-12">
        <table class="table table-sm">
          <tr>
            <th>ID</th>
            <th>Fornecedor</th>
            <th>Data de Lançamento</th>
            <th>Data de Pagamento</th>
            <th>Data de Vencimento</th>
            <th>Profissional</th>
            <th>Pago</th>
            <th>Valor R$</th>
            <th>Ações</th>
          </tr>
          @foreach ($conpags as $conpag)
          <tr>
            <td>{{$conpag->NUMERO}}</td>
            <td>{{$conpag->CODFOR}} - {{$conpag->Nome}} </td>
            <td>{{$conpag->DATA}}</td>
            <td>{{$conpag->DTPAG}}</td>
            <td>{{$conpag->DTVENC}}</td>
            <td>{{$conpag->dsNomeMedico}}</td>
            <td>{{$conpag->PAGO}}</td>
            <td>{{$conpag->VALOR}}</td>
            <td>
              <a href="{{route('conpag.destroy', $conpag->NUMERO)}}" class="actions delete">
                <i class="far fa-trash-alt" style="font-size:20px;"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </table>
        <div class="row justify-content-end">
          <label>Total Recebido R$: {{$totalRecebido}} =======</label>
          <label>Total Receber R$: {{$totalReceber}}</label>
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
  function toVlPago() {

    var tipoPagto = document.getElementById("PAGO").value
    var vlPago = document.getElementById("Valor").value
    var dtPagto = document.getElementById("DATA").value

    if (tipoPagto == "S") {
      document.getElementById("Valor_Pago").value = vlPago
      document.getElementById("DTPAG").value = dtPagto
    } else {
      document.getElementById("Valor_Pago").value = 0
    }
  }
</script>