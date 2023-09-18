@foreach ($tbexamesPDF as $tbexamesPDFs)
@endforeach
<!DOCTYPE html>
<html>
<head>
	<title>Exame do Paciente {{$tbexamesPDFs->nomecli}}</title>
</head>
<body>
    <h1>Nome Paciente: {{ $tbexamesPDFs->nomecli }}</h1>
    <p>Medico: {{ $tbexamesPDFs->medico }}</p>
    <p>------------------------------------------------</p>
    <h2>Exames</h2>
    @foreach ($examesItens as $examesIten)
    <p>{{ $examesIten->nome }}</p>
    @endforeach
    <h2>Observações</h2>
    <p>{{ $tbexamesPDFs->obs }}</p>
</body>
</html>
