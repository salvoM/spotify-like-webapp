@extends('layouts.cambio')
@if (count($playlists)>0)
@section('content')
<script src="{{asset('js/collections.js')}}" defer="true"></script>
    @foreach ($errors->all() as $error)
    <div class="alert alert-warning alert-dismissible fade show mb-3" role="alert">
        <strong>Attenzione!</strong> {{$error}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endforeach

  <h2 class="text-center text-white mt-3 mb-5">Ciao <strong>{{Auth::user()->username}}</strong>, ecco le tue playlists!</h2>

    <form class="form" method="post" name="form_create">
        @csrf
        <div class="d-flex justify-content-start container mt-4">
          <div class="col-6">
            <input class="form-control form-control-lg mr-sm-2 text-white" data-toggle="tooltip" data-placement="bottom" title="Inserisci il titolo della tua playlist" style="background-color: #112C29" type="search" placeholder="Crea una nuova playlist!" name="playlist" aria-label="Search">
          </div>
          <div class="col-6">
            <button class="btn btn-sm btn-secondary" style="height: 100%; width:40%" data-toggle="tooltip" data-placement="right" title="Crea subito una nuova playlist!" type="submit">Crea!</button>
          </div>
        </div>
    </form>
    <div id="content-group" class="mt-5 p-2 container">
      {{-- <div class="card-columns"> --}}
          <div class="row">
        @foreach ($playlists as $pl )
              <div class="col-sm-4 my-2">
                  <div class="card text-white bg-dark border-white" style="">
                      <img class="card-img-top" src="{{$pl->url_img}}" alt="Card image cap">
                      <div class="card-body">
                        <p class="card-text">{{$pl->titolo}}</p>
                        <a href="/collection/{{$pl->id}}" class="btn btn-secondary">Apri</a>
                        <button data-id="{{$pl->id}}" data-delete="1" class="btn btn-danger float-right">Elimina</a>

                      </div>
                  </div>
              </div>
        @endforeach
          </div>
     {{-- </div> --}}
    </div>

@endsection
    @else
    @section('content')
    <script src="{{asset('js/collections.js')}}" defer="true"></script>
    <div class="d-flex justify-content-center mt-3">
      <div class="jumbotron mt-2 col-6">
          <div class="col-12 d-flex justify-content-between">
                  <div class="col-12">
                  <h1 class="mb-4">Ciao, <strong>{{ Auth::user()->username }}</strong>, non hai neanche una playlist! </h1>
                    <a href="#" class="btn btn-secondary mt-3" data-toggle="modal" data-target="#create_collection">Crea una nuova playlist</a>
                  </div>
          </div>
      </div>
    </div>

    {{-- Modale --}}
    
      <div class="modal fade" id="create_collection" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header border-0" style="background-color: #112C29">
              <h5 class="modal-title text-white" id="exampleModalCenterTitle">Scegli un nome accattivante, dai sfogo alla tua creatività!</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="/collection" method="POST" name="firstPlaylist">
                @csrf
                <div class="modal-body" style="background-color:#323D39">
                    {{-- <div class="text-white mb-2"> Scegli un nome accattivante, dai sfogo alla tua creatività!</div> --}}
                    <input type="text" class="form-control mt-2" placeholder="Nome della playlist" aria-label="name" name="playlist">
                </div>
                <div class="modal-footer d-flex justify-content-between border-0" style="background-color: #112C29">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  <button id="create-btn" type="submit" class="btn btn-secondary">Create</button>
                </div>
            </form>
          </div>
        </div>
      </div>

    @endsection
@endif
