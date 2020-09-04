@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span>Médicos</span>
                    <a href="{{ route('doctors.create') }}">
                        <button class="btn-dark">Novo Médico</button>
                    </a>
                </div>

                <div class="card-body">
                    <table id="doctors_table" class="my_datatable table">
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
                            @foreach($doctors as $doctor)
                                <tr>
                                    <th scope="col">{{ $doctor->id }}</th>
                                    <td>{{ $doctor->name }}</td>
                                    <td>{{ $doctor->phone }}</td>
                                    <td>{{ $doctor->email }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('doctors.edit', $doctor->id) }}" class="mr-1">
                                            <button class="btn-warning">Editar</button>
                                        </a>
                                        <a href="{{ route('doctors.show', $doctor->id) }}" class="mr-1">
                                            <button class="btn-info">Ver</button>
                                        </a>
                                        <form action="{{ route('doctors.destroy' , $doctor->id)}}" method="POST">
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
