<?php

namespace App\Http\Controllers;

use App\Track;
use App\Collection;
use App\Http\Requests\TrackRequest;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(TrackRequest $request)
    {
        $request->validated();      //Validazione richieste

        $track = Track::where('spotify_uri', request('spotify_uri'))->get();
        if($track->isEmpty() ){
            //Se la tracks non è in tabella la inserisco
            $track = new Track();
            $track->title = request('title');
            $track->artists = request('artist');
            $track->image_url = request('image_url');
            $track->album_name = request('album_name');
            $track->spotify_uri = request('spotify_uri');
            $track->save();
        }
        //Altrimenti la inserisco solo nella tabella pivot
        
        if(Collection::find(request('collection'))->tracks->isEmpty()){
            //Se è il primo elemento della playlist aggiorno la copertina
            $coll = Collection::find(request('collection'));
            $coll->url_img = request('image_url');
            $coll->save();
        }

        Collection::find(request('collection'))->tracks()->attach($track->id);
        //Inserisco solo se non è già nella raccolta
        // if ( Collection::find(request('collection'))->tracks->where('spotify_uri', request('spotify_uri'))->isEmpty() ) {
        //      Collection::find(request('collection'))->tracks()->attach($track->id);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Track  $track
     * @return \Illuminate\Http\Response
     */
    public function show(Track $track)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Track  $track
     * @return \Illuminate\Http\Response
     */
    public function edit(Track $track)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Track  $track
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Track $track)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Track  $track
     * @return \Illuminate\Http\Response
     */
    public function destroy(Track $track, Collection $collection)
    {
        //
    }

    public function deleteTrackFromCollection(Track $track, Collection $collection)
    {
        //
        $collection->tracks()->detach($track->id);
        if ($collection->tracks->isEmpty()) {
            $collection->url_img = "/images/background6.jpg";
            $collection->save();
        }
        if($track->collections->isEmpty()){
            $track->delete();
        }
        return redirect()->back();
    }
}
