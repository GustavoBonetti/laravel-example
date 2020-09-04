@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span>Pacientes</span>
                    <a href="{{ route('patients.create') }}">
                        <button class="btn-dark">Novo Paciente</button>
                    </a>
                </div>

                <div class="card-body">
                    <table id="patients_table" class="my_datatable table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patients as $patient)
                                <tr>
                                    <th scope="col">{{ $patient->id }}</th>
                                    <td>{{ $patient->name }}</td>
                                    <td>{{ $patient->phone }}</td>
                                    <td>{{ $patient->email }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('patients.edit', $patient->id) }}" class="mr-1">
                                            <button class="btn-warning">Editar</button>
                                        </a>
                                        <a href="{{ route('patients.show', $patient->id) }}" class="mr-1">
                                            <button class="btn-info">Ver</button>
                                        </a>
                                        <form action="{{ route('patients.destroy' , $patient->id)}}" method="POST">
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
