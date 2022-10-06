@php
        if(count($collection->tracks) > 0 && count($collection->tracks) < 6   ){
            $tracks = array();
            foreach ($collection->tracks as $track) {
                # code...
            }
        }   
        elseif(count($collection->tracks) > 6){
            $tracks = array();
            for ($i=0; $i < 6; $i++) { 
                array_push($tracks, $collection->tracks[$i]);
            }
        }
@endphp

@extends('layouts.cambio')
@section('content')
    <div class="d-flex justify-content-center">
    <div class="jumbotron mt-2 col-9">
        <div class="col-12 d-flex justify-content-between">
                <div class="col-8">
                    <h1 class="mb-4">{{$collection->titolo}} </h1>
                    {{-- <p></p> --}}
                    @if (count($collection->tracks) > 0)
                        <p>
                            In questa playlist: 
                            <ul>
                            @foreach ($tracks as $track)
                                <li>{{$track->title}}, di {{$track->artists}}</li>    
                            @endforeach
                            </ul>
                        </p>
                    @else
                        <p>
                          Al momento la playlist è vuota! <br> <br> Riempila subito con le tue canzoni preferite!  
                        </p>
                    @endif


                   <div class="d-flex flex-column justify-content-end">
                        <div class="">
                            <a href="/collection/{{$collection->id}}/edit" class=" btn btn-outline-secondary float-left">Modifica</a>  
                        </div>
                    </div> 
                </div>
                <div class="col-4 d-flex justify-content-center">
                <img src="{{$collection->url_img}}" alt="" srcset="" style="width:300px; height:300px;" class="img-fluid img-thumbnail">
                </div>
        </div>
    </div>
    </div>
    
    @if (count($collection->tracks) > 0)
    <div class="container d-flex flex-wrap col-9">
        @foreach ($collection->tracks as $track )
            <div class="col-sm-3 my-2">
                <div class="card text-white bg-dark border-white" style="">
                    <img class="card-img-top img-fluid" src="{{$track->image_url}}" alt="Card image cap" >
                    <div class="card-body">
                        <p class="card-text">{{$track->title}}</p>
                        <div class="button">
                            <a href="https://open.spotify.com/track/{{substr($track->spotify_uri, 14)}}" class="btn btn-secondary">Ascolta</a>
                            <form method="POST" action="/track/{{$track->id}}/{{$collection->id}}" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button data-deleteid="{{$track->id}}" type="submit" name="{{$track->id}}" class="btn btn-danger float-right">Elimina</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endif
    
@endsection