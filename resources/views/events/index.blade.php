@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h1>Mis eventos</h1>
        </div>
        <div class="card-body">
           <div class="row">
                @forelse ($events as $e)
                    @if(auth()->user()->role->poder==2 && $e->confirmado)
                        <div class="col-md-4 col-sm-12">
                            <div class="card">
                                <div class="row">
                                    @foreach ($e->photo->all() as $photo)
                                       <div class="col-2">
                                            <img src="{{env('APP_URL').$photo->path}}" width="100px">
                                       </div>
                                    @endforeach
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">{{$e->tipo}} <span class="badge @if($e->confirmado) badge-success @else bagge-danger @endif">{{$e->confirmado?'✅':'❎'}}</span></h4>
                                    <p class="card-text">{{$e->fecha}}, {{$e->hora}}</p>
                                </div>
                                <div class="card-footer">
                                    <p>
                                      Precio: ${{$e->precio?'$'.$e->precio:'No asignado'}}
                                    </p>
                                    <div class="btn-group">
                                        <form action="{{route('events.photos',$e)}}" method="POST" enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            <input type="file" draggable="true" name="foto" id="foto" required>
                                            <button class="btn btn-primary" type="submit">Subir foto</button>
                                        </form>
                                        <a class="btn btn-success" href="{{route('events.show',$e)}}" style="max-height:37px;">Ver</a>
                                        <a class="btn btn-warning" href="{{route('payments.create',$e)}}" style="max-height:37px;">Abonar</a>
                                    </div>
                                    <div class="btn-group">
                                        @foreach ($e->photo->all() as $photo)
                                            <a class="nav-link" target="_blank" href="{{env('APP_URL').$photo->path}}">Foto({{$loop->iteration}})</a>
                                            <form action="{{route('photos.destroy',$photo)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit">x</button>
                                            </form>
                                        @endforeach
                                    </div
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-md-4 col-sm-12">
                            <div class="card">
                                <div class="row">
                                    @foreach ($e->photo->all() as $photo)
                                    <div class="col-2">
                                            <img src="{{env('APP_URL').$photo->path}}" width="100px">
                                    </div>
                                    @endforeach
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">{{$e->tipo}} <span class="badge @if($e->confirmado) badge-success @else bagge-danger @endif">{{$e->confirmado?'✅':'❎'}}</span></h4>
                                    <p class="card-text">{{$e->fecha}}, {{$e->hora}}</p>
                                </div>
                                <div class="card-footer">
                                    <p>
                                    {{$e->precio?'$'.$e->precio:'No asignado'}}
                                    </p>
                                        <div class="btn-group">
                                            <form action="{{route('events.photos',$e)}}" method="POST" enctype="multipart/form-data">
                                                @method('put')
                                                @csrf
                                                <input type="file" draggable="true" name="foto" id="foto" required>
                                                <button class="btn btn-primary" type="submit">Subir foto</button>
                                            </form>
                                        </div>
                                        <div class="btn-group">
                                            <a class="btn btn-primary" href="{{route('events.show',$e)}}" style="max-height:37px;">Ver</a>
                                            @if((auth()->user()->role->poder==3 || auth()->user()->role->poder==1) && !$e->confirmado)
                                                <a class="btn btn-dark" href="{{route('events.edit',$e)}}" style="max-height:37px;">Editar</a>
                                                <form action="{{route('events.destroy',$e)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger">Eliminar</button>
                                                </form>
                                            @endif
                                            @if((auth()->user()->role->poder==3 || auth()->user()->role->poder==2) && $e->confirmado)
                                                <a class="btn btn-warning" href="{{route('payments.create',$e)}}" style="max-height:37px;">Abonar</a>
                                            @endif

                                            @if(auth()->user()->role->poder==3 && !$e->confirmado)
                                                <a class="btn btn-success" href="{{route('events.confirm',$e)}}" style="max-height:37px;">confirmar</a>
                                            @endif
                                        </div>
                                    <div class="btn-group">
                                        @foreach ($e->photo->all() as $photo)
                                            <a class="nav-link" target="_blank" href="{{env('APP_URL').$photo->path}}">Foto({{$loop->iteration}})</a>
                                            <form action="{{route('photos.destroy',$photo)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit">x</button>
                                            </form>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <tr>
                        <td colspan="5">No hay eventos</td>
                    </tr>
                @endforelse
           </div>
        </div>
    </div>
    {{$events->links()}}
</div>

@endsection
<style>
    li{
        list-style: none;
    }
</style>
