@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        Crear usuario
                    </div>
                    <div class="card-body">
                        <form action="{{route('users.store')}}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role_id" class="col-md-4 col-form-label text-md-right">Rol</label>

                                <div class="col-md-6">
                                   <select name="role_id" id="role_id" class="form-control">
                                        @foreach (\App\Role::all() as $role)
                                            <option value="{{$role->id}}">{{$role->nombre}}</option>

                                        @endforeach
                                   </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
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
        </div>
    </div>
@endsection
