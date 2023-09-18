@extends('layouts.app')

@section('content')
<div class="container" style="background-color: #ffffff; align-content:center; align-items:center;border: 2px solid;border-radius: 12px;">
    <h1 style="color: #008ae6; text-align: center; font-weight:bold" >SisMedic Web</h1>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <img src="{{ url('/logo/logoMedico.png')}}" alt="...">
        </div>
        <div class="col-md-8 my-4">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="usuario" class="col-sm-4 col-form-label text-md-right">{{ __('Usuario') }}</label>

                            <div class="col-md-6">

                                <select name="name" class="form-control">
                                    <option value="">Selecione o usuario</option>
                                    @foreach ($usuarios as $usuario)
                                    <option value="{{$usuario->Usuario}}">{{$usuario->Usuario}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection