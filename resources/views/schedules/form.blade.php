@extends('layouts.app')

@section('content')
    <div class="container">

        <form method="POST"
              action="{{ isset($schedule) && $schedule ? route('schedules.update', $schedule->id) : route('schedules.store') }}">
            @csrf
            @if(isset($schedule) && $schedule) @method('PUT') @endif
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="date">Data</label>
                    <input type="date" class="form-control" name="date" id="date"
                           value="{{ old('date', $schedule->date ?? null) }}"
                           {{ isset($disabled) ? 'disabled' : null }} required>
                </div>
                <div class="col-md-4">
                    <label for="time">Horário</label>
                    <input type="time" class="form-control" name="time" id="time"
                           value="{{ old('time', $schedule->time ?? null) }}"
                           {{ isset($disabled) ? 'disabled' : null }} required>
                </div>
                <div class="col-md-4">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control" {{ isset($disabled) ? 'disabled' : null }}>
                        <option disabled selected>Escolha uma opção</option>
                        @foreach($status as $item)
                            <option
                                {{ isset($schedule) && $schedule->status_id == $item->id ? 'selected' : null }}
                                value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="patient">Paciente</label>
                    <select id="patient" name="patient" class="form-control" {{ isset($disabled) ? 'disabled' : null }}>
                        <option disabled selected>Escolha uma opção</option>
                        @foreach($patients as $patient)
                            <option
                                {{ isset($schedule) && $schedule->patient_id == $patient->id ? 'selected' : null }}
                                value="{{ $patient->id }}">{{ $patient->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="doctor">Médico</label>
                    <select id="doctor" name="doctor" class="form-control" {{ isset($disabled) ? 'disabled' : null }}>
                        <option disabled selected>Escolha uma opção</option>
                        @foreach($doctors as $doctor)
                            <option
                                {{ isset($schedule) && $schedule->doctor_id == $doctor->id ? 'selected' : null }}
                                value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @if(!isset($disabled))
                <button type="submit" class="btn btn-primary">
                    {{ isset($schedule) && $schedule ? 'Atualizar' : 'Salvar' }}
                </button>
            @endif
            <a href="{{ route('schedules.index') }}">
                <input type="button" class="btn btn-secondary" value="Voltar"/>
            </a>
        </form>
    </div>
@endsection
