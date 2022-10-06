@extends('layouts.cambio')



@php
    if($collection->url_img == "/images/background6.jpg" || $collection->url_img == "http://127.0.0.1:8000/images/background6.jpg"){
        $img = "https://hoyenapple.com/wp-content/uploads/2019/04/Musica.jpg";
    }
    else {
        $img = $collection->url_img;
    }
@endphp
@section('content')

<div class="d-flex justify-content-center">
        <div class="jumbotron mt-2 col-9">
            <div class="col-12 d-flex justify-content-between">
                    <div class="col-8">
                        <h1>Modifica la playlist</h1>
                        <h3 class="mb-4"><strong> {{$collection->titolo}} </strong></h3>
                            <br>
                            <form action="/collection/{{$collection->id}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{$collection->titolo}}" name="newCollectionName" placeholder="Nome della playlist" aria-describedby="emailHelp" placeholder="Enter email">
                                    <small class="form-text text-muted">Playlist triste o  rockeggiante? Dai sfogo alla tua creatività!</small>
                                    @error('newCollectionName')
                                    <div class="text-black p-2 mb-2 alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="newImg" value="{{$img}}" placeholder="Url dell'imagine di copertina">
                                    <small class="form-text text-muted">L'immagine non rappresenta la playlist? Cambiala!</small>
                                    @error('newImg')
                                    <div class="text-black p-2 mb-2 alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <br>
                                <button type="submit" class="btn btn-outline-secondary">Salva</button>
                            </form>
                       
                    </div>
                    <div class="col-4 d-flex justify-content-center">
                    <img src="{{$collection->url_img}}" alt="" srcset="" style="width:300px; height:300px;" class="img-fluid img-thumbnail">
                    </div>
            </div>
        </div>
        </div>


@endsection