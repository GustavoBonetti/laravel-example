@extends('layouts.app')

@section('content')
    <div class="container">

        <form method="POST" action="{{ isset($doctor) && $doctor ? route('doctors.update', $doctor->id) : route('doctors.store') }}">
            @csrf
            @if(isset($doctor) && $doctor) @method('PUT') @endif
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $doctor->name ?? null) }}"
                    {{ isset($disabled) ? 'disabled' : null }} required>
            </div>
            <div class="form-group">
                <label for="phone">Telefone</label>
                <input type="tel" class="form-control phone-mask" name="phone" id="phone"
                       value="{{ old('phone', $doctor->phone ?? null) }}"
                    {{ isset($disabled) ? 'disabled' : null }} required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email"
                       value="{{ old('email', $doctor->email ?? null) }}"
                    {{ isset($disabled) ? 'disabled' : null }} required>
            </div>
            @if(!isset($disabled))
            <button type="submit" class="btn btn-primary">
                {{ isset($doctor) && $doctor ? 'Atualizar' : 'Salvar' }}
            </button>
            @endif
            <a href="{{ route('doctors.index') }}">
                <input type="button" class="btn btn-secondary" value="Voltar"/>
            </a>
        </form>
    </div>
@endsection
