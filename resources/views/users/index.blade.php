@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span>Usuários</span>
                    <a href="{{ route('users.create') }}">
                        <button class="btn-dark">Novo Usuário</button>
                    </a>
                </div>

                <div class="card-body">
                    <table id="users_table" class="my_datatable table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Email</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="col">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('users.edit', $user->id) }}" class="mr-1">
                                            <button class="btn-warning">Editar</button>
                                        </a>
                                        <a href="{{ route('users.show', $user->id) }}" class="mr-1">
                                            <button class="btn-info">Ver</button>
                                        </a>
                                        <form action="{{ route('users.destroy' , $user->id)}}" method="POST">
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
