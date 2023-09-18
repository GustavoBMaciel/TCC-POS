@foreach ($tbmedicamentosPDF as $tbmedicamentosPDFs)
@endforeach
<!DOCTYPE html>
<html>
<head>
	<title>Medicamentos do Paciente {{$tbmedicamentosPDFs->nomecli}}</title>
</head>
<body>
   <h1>Data: {{ $tbmedicamentosPDFs->data }}</h1>
    <h1>Nome Paciente: {{ $tbmedicamentosPDFs->nomecli }}</h1>
    <p>Medico: {{ $tbmedicamentosPDFs->medico }}</p>
    <p>------------------------------------------------</p>
    <h2>Medicamentos</h2>

    @foreach ($medicamentosItens as $medicamentosIten)
    <p>Nome: {{$medicamentosIten->nome}}</p>
    <p>Posologia: {{$medicamentosIten->posologia}}</p>
    <p>Concentração: {{$medicamentosIten->concentracao}}</p>
    <p>Administração: {{$medicamentosIten->administracao}}</p>
    <p>Quantidade: {{$medicamentosIten->qtde}}</p>
    <p>------------------------------------------------</p>
    @endforeach
    
    <h2>Observações</h2>
    <p>{{ $tbmedicamentosPDFs->obs }}</p>
</body>
</html>
