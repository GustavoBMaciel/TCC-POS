@foreach ($clientePDF as $clientePDFs)
@endforeach
<!DOCTYPE html>
<html>
<head>
	<title>{{$clientePDF[0]->Cod}}</title>
</head>
<body>
    <h1>Nome: {{ $clientePDFs->nome }}</h1>
    <p>CPF: {{ $clientePDFs->dsCPF }} - Email: {{ $clientePDFs->dsEmail }}</p>
    <p>Cadastrado em: {{ $clientePDFs->dtcad }}.</p>
    <p>Nascido em: {{ $clientePDFs->dtnasc }}.</p>
    <p>Endereço: {{ $clientePDFs->rua }}, numero {{ $clientePDFs->numero }}, {{ $clientePDFs->compl }}, {{ $clientePDFs->Bairro }} - {{ $clientePDFs->Cidade }}/{{ $clientePDFs->uf }}.</p>
    <p>Telefone: {{ $clientePDFs->fone }}   - Celular: {{ $clientePDFs->celular }} .</p>
    <p>Convenio: {{ $clientePDFs->convenio }}.</p>
    <p>Observações: {{ $clientePDFs->Obs }}.</p>
</body>
</html>