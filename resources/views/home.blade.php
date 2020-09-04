@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <a href="{{ route('users.index') }}">
                        <div class="h4">Agendamentos</div>
                    </a>
                    <a href="{{ route('users.index') }}">
                        <div class="h4">Doutores</div>
                    </a>
                    <a href="{{ route('users.index') }}">
                        <div class="h4">Pacientes</div>
                    </a>
                    <a href="{{ route('users.index') }}">
                        <div class="h4">Usuários</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
