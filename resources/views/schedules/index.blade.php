@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span>Agendamentos</span>
                    <a href="{{ route('schedules.create') }}">
                        <button class="btn-dark">Novo Agendamento</button>
                    </a>
                </div>

                <div class="card-body">
                    <table id="schedules_table" class="my_datatable table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Data e hora</th>
                                <th scope="col">Status</th>
                                <th scope="col">Paciente</th>
                                <th scope="col">Médico</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedules as $schedule)
                                <tr>
                                    <th scope="col">{{ $schedule->id }}</th>
                                    <td>{{ date('d/m/Y', strtotime($schedule->date)) . ' ' . $schedule->time }}</td>
                                    <td>{{ $schedule->status->name }}</td>
                                    <td>{{ $schedule->patient->name }}</td>
                                    <td>{{ $schedule->doctor->name }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('schedules.edit', $schedule->id) }}" class="mr-1">
                                            <button class="btn-warning">Editar</button>
                                        </a>
                                        <a href="{{ route('schedules.show', $schedule->id) }}" class="mr-1">
                                            <button class="btn-info">Ver</button>
                                        </a>
                                        <form action="{{ route('schedules.destroy' , $schedule->id)}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE" />
                                            <button class="btn-danger delete">Deletar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
