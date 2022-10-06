@extends('layouts.cambio')
@section('content')
<script src="{{asset('js/search.js')}}" defer="true"></script>
<form class="form" method="post" name="form">
    @csrf
    <div class="form-group row d-flex mt-5 justify-content-center align-items-center">
        <div class="col-10 mb-2">
            <input class="form-control form-control-lg mr-sm-2 text-white" style="background-color: #112C29" type="search" placeholder="Search" name="searchtag" aria-label="Search">
        </div>
        <div class="col-sm-3 m-3 d-flex  justify-content-center align-items-center">
            <button class="btn btn-sm btn-outline-success" style="height: 100%; width:40%" type="submit">Search</button>
        </div>
    </div>
</form>

<div id="content-group" class="card-columns mt-5 ">

</div>
    
  <!-- Modal -->
  <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header text-white border-0" style="background-color: #112C29">
          <h5 class="modal-title" id="modalTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
          </button>
        </div>
        <div class="modal-body " style="background-color: #323D39">
          <form action="" method="POST" name="addCollection">
            @csrf
              {{-- <img src="Metto l'url dell'immagine della card da cui viene cliccato il button" alt=""> --}}
            <div class="d-flex flex-column justify-content-center align-items-center">
              <div class="col-10">
                  <div class="card m-2 p-0 text-white bg-dark border-black">
                      <img id="modalImg" class="card-img-top" src="https://i.scdn.co/image/0387f4202c018e9ab70cc4942206182c48d9d0de" data-uri="spotify:track:28K0EWlGlIbWmP4gntQGL9">
                  </div>
              </div>
              {{-- Come si mette il breakpoint nelle immagini? --}}
                <div class="mt-4 col-10 text-white">
                  <span>Seleziona la playlist in cui aggiungere la canzone: </span>
                    <select name="collection" class="custom-select bg-secondary border-dark text-white" required>
                    @if (count($collections) > 0)
                      @foreach ($collections as $c )
                        <option value="{{$c->id}}">{{$c->titolo}}</option>
                      @endforeach
                    @else
                      <option value="none" selected>Non possiedi alcuna playlist!</option>
                    @endif
                    
                            {{-- <option selected>Scegli un'opzione</option> --}}
                            
                    </select>              
                </div>
            </div>
          </form>
        </div>
        <div class="modal-footer d-flex justify-content-between border-0" style="background-color: #112C29">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Chiudi</button>
          <button type="button" id="addToPlaylist" class="btn btn-dark">Aggiungi</button>
        </div>
      </div>
    </div>
  </div>
@endsection