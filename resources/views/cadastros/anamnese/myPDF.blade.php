@foreach ($anamnesePDF as $anamnesePDFs)
@endforeach
<!DOCTYPE html>
<html>
<head>
	<title>Anamense do cliente {{$anamnesePDFs->nome}}</title>
</head>
<body>
    <h1>Nome Paciente: {{ $anamnesePDFs->nome }}</h1>
    <p>Data da Consulta: {{ $anamnesePDFs->data }}.</p>
    <p>Medico: {{ $anamnesePDFs->medico }}.</p>
    <p>Observações: {{ $anamnesePDFs->Questionario }}.</p>
</body>
</html>
