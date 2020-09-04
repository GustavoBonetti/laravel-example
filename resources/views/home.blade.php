@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <a href="{{ route('users.index') }}">
                        <h4 class="text-dark">Agendamentos</h4>
                    </a>
                    <a href="{{ route('users.index') }}">
                        <h4 class="text-dark">Doutores</h4>
                    </a>
                    <a href="{{ route('patients.index') }}">
                        <h4 class="text-dark">Pacientes</h4>
                    </a>
                    <a href="{{ route('users.index') }}">
                        <h4 class="text-dark">Usuários</h4>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
