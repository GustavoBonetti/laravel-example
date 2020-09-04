@extends('layouts.app')

@section('content')
    <div class="container">

        <form method="POST" action="{{ isset($user) && $user ? route('users.update', $user->id) : route('users.store') }}">
            @csrf
            @if(isset($user) && $user) @method('PUT') @endif
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $user->name ?? null) }}"
                    {{ isset($disabled) ? 'disabled' : null }} required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email"
                       value="{{ old('email', $user->email ?? null) }}"
                    {{ isset($disabled) ? 'disabled' : null }} required>
            </div>
            @if(isset($user) && $user && !isset($disabled))
                <div class="form-group">
                    <label for="password_old">Senha antiga</label>
                    <input type="password" class="form-control" name="password_old" id="password_old">
                </div>
            @endif
            @if(!isset($disabled))
            <div class="form-group">
                <label for="password">Senha {{ isset($user) && $user ? 'nova' : null }}</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="form-group">
                <label for="password_confirm">Confirmar senha</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirm">
            </div>
            <button type="submit" class="btn btn-primary">
                {{ isset($user) && $user ? 'Atualizar' : 'Salvar' }}
            </button>
            @endif
            <a href="{{ route('users.index') }}">
                <input type="button" class="btn btn-secondary" value="Voltar"/>
            </a>
        </form>
    </div>
@endsection
