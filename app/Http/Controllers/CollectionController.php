<?php

namespace App\Http\Controllers;

use App\Collection;
use App\Track;
use App\Http\Requests\UpdateCollectionRequest;
use Illuminate\Http\Request;
use Auth;


class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $playlists = json_decode($this->getCollections());
        return view("collections", compact('playlists'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'playlist' => 'required|string|max:255',
        ]);
        $playlist = new Collection();
        $playlist->titolo = request('playlist');
        $playlist->url_img = url('/images/background6.jpg');
        $playlist->id_utente = Auth::user()->id;
        $playlist->save();
        return $playlist->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $collection)
    {
        //
        $tracks = $collection->tracks;
        return view("collection", compact('collection', 'tracks'));        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function edit(Collection $collection)
    {
        //
        return view("edit", compact('collection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCollectionRequest $request, Collection $collection)
    {
        $request->validated();
        $collection->titolo = request('newCollectionName');
        $collection->url_img = request('newImg');
        $collection->save();
        return redirect('/collection');

    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $collection)
    {
        foreach($collection->tracks as $track){
           $delete = false;
           foreach($track->collections as $coll){
               //Scorro tutte le collezioni in cui si trova una traccia
               if($coll->id != $collection->id){
                   //Se la track ha una collection che non è quella che voglio eliminare
                   $delete = false;
               }
               else {
                   $delete = true;
               }
           }
           if($delete){
               $coll->tracks()->detach($track->id);
               $track->delete();
           } 
        }
        $collection->tracks()->detach();
        $collection->delete();
        return "OK";
    }

    public function getCollections(){
        return json_encode(Auth::user()->collections);
    }
    
}
