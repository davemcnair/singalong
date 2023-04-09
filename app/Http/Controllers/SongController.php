<?php

namespace App\Http\Controllers;

use App\Http\Requests\SongData;
use App\Http\Requests\UpdateSongRequest;
use App\Models\Song;
use App\Models\Tag;
use Illuminate\Contracts\View\View;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $songs = Song::latest()->paginate(10);

        return view('songs.index', compact('songs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('songs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SongData $data)
    {
        /** @var Song $song */
        $song = Song::create($data->all());
        foreach($data->tags as $tagData){
            $tag = Tag::firstOrCreate([
                'name'=> $tagData->name
            ]);
            $song->tags()->attach($tag->id);
        }



        return redirect()->route('songs.index')
            ->withSuccess(__('Song created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Song $song): View
    {
        return view('songs.show', [
            'song' => $song
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Song $song): View
    {
        return view('songs.edit', [
            'song' => $song
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSongRequest $request, Song $song)
    {
        $song->update($request->validated());

        return redirect()->route('songs.index')
            ->withSuccess(__('Song updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Song $song)
    {
        $song->delete();

        return redirect()->route('songs.index')
            ->withSuccess(__('Song deleted successfully.'));
    }
}
