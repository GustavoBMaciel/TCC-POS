<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name') }}</title>


  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
  <link rel="stylesheet" href="{{url('assests/css/style.css')}}">

  <link rel="stylesheet" href="{{url('css/home.css')}}">



  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar navbar-light" style="background-color: #e3f2fd;">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
          Home
        </a>
        <div class="form-row align-items-center">
          <div class="dropdown" >
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #e3f2fd; color: black; border-style: none">
              Cadastros
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2" style="background-color: #e3f2fd;">
              <a href="{{route('cliente.create')}}" class="dropdown-item">
                <strong>Pacientes</strong>
              </a>
              <a href="{{route('convenio.create')}}" class="dropdown-item">
                <strong>Convenios</strong>
              </a>
              <a href="{{route('tipo.create')}}" class="dropdown-item">
                <strong>Tipos de Pacientes</strong>
              </a>
              <a href="{{route('profissao.create')}}" class="dropdown-item">
                <strong>Profissões</strong>
              </a>
              <a href="{{route('fornecedor.create')}}" class="dropdown-item">
                <strong>Fornecedores</strong>
              </a>
              <a href="{{route('tbtipoagendamento.create')}}" class="dropdown-item">
                <strong>Tipos Agendamento</strong>
              </a>
              <a href="{{route('tbstatusagenda.create')}}" class="dropdown-item">
                <strong>Status de Agenda</strong>
              </a>
              <a href="{{route('acesso.create')}}" class="dropdown-item">
                <strong>Usuários</strong>
              </a>
              <a href="{{route('exame.create')}}" class="dropdown-item">
                <strong>Exames</strong>
              </a>
              <a href="{{route('medicamento.create')}}" class="dropdown-item">
                <strong>Medicamentos</strong>
              </a>
              <a href="{{route('cid10.index')}}" class="dropdown-item">
                <strong>CID 10</strong>
              </a>
              <a href="{{route('agenda.create')}}" class="dropdown-item">
                <strong>Agenda</strong>
              </a>
              <a href="{{route('profissional.create')}}" class="dropdown-item">
                <strong>Profissional</strong>
              </a>
              <a href="{{route('permissao.create')}}" class="dropdown-item">
                <strong>Permissão</strong>
              </a>
            </div>
          </div>
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #e3f2fd; color: black; border-style: none">
              Financeiro
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2" style="background-color: #e3f2fd; color: black;">
              <a href="{{route('caixa.create')}}" class="dropdown-item">
                <strong>Caixa</strong>
              </a>
              <a href="{{route('conrec.create')}}" class="dropdown-item">
                <strong>Contas a Receber</strong>
              </a>
              <a href="{{route('conpag.create')}}" class="dropdown-item">
                <strong>Contas a Pagar</strong>
              </a>
            </div>
          </div>
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #e3f2fd; color: black; border-style: none;">
              Impressos
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2" style="background-color: #e3f2fd; color: black;">
              <a href="{{route('tbexames.create')}}" class="dropdown-item">
                <strong>Exames</strong>
              </a>
              <a href="{{route('tbmedicamentos.create')}}" class="dropdown-item">
                <strong>Medicamentos</strong>
              </a>
            </div>
          </div>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">

          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            <!--
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        -->
            @else
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                @if ( Auth::user()->permissao == 'admin')
                <a class="dropdown-item" href="{{ url('/users') }}">{{ __('Gerenciar Usuarios') }} <i class="fas fa-user-cog"></i></a>
                @endif

                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                  {{ __('Sair') }}
                  <i class="fas fa-sign-out-alt"></i></a>


                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>

    <main class="py-4">
      @yield('content')
    </main>
  </div>
</body>

</html>