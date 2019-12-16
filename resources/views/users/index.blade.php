@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Usuarios registrados</h1>
            </div>
            <div class="card-body">
                <table class="table table-striped table-inverse table-responsive">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td scope="row">{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->role->nombre}}</td>
                                    <td>
                                        @if(auth()->user()->role->poder==3)
                                        <div class="btn-group">
                                            <a class="btn btn-warning" href="{{route('users.edit',$user)}}">Editar</a>

                                            <form action="{{route('users.destroy',$user)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit">Eliminar</button>
                                            </form>
                                        </div>
                                        <div class="btn-group">
                                            <form action="{{route('users.password',$user)}}" method="POST">
                                                @csrf
                                                @method('put')
                                                <input type="password" class="form-control" name="password" id="password" placeholder="nueva contraseña">
                                                <button style="width:100%" class="btn btn-danger" type="submit">Restablecer</button>
                                            </form>
                                        </div>
                                        @endif
                                    </th>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" scope="row">No hay usuarios</td>
                                </tr>
                            @endforelse
                        </tbody>
                </table>
            </div>
            {{$users->links()}}
        </div>
    </div>
@endsection
