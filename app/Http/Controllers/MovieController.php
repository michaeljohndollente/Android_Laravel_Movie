<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::with('genre', 'producer', 'roles.actor')->get();
        return response()->json(['movies' => $movies], 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $movie = Movie::create([
            "title"=>$request->title,
            "description"=>$request->description,
            "release"=>$request->release,
            "genre_id"=>$request->genre_id,
            "producer_id"=>$request->producer_id,
            "imgpath"=>'storage/images/'.trim($request->title).'.jpeg'
        ]);
        Storage::put('public/images/'.trim($request->title).'.jpeg', base64_decode($request->imgpath));
        return response()->json([
            "message"=>"Movie has been added."
        ],200);
    }

    public function show($id)
    {
        $movie = Movie::with('genre', 'producer', 'roles.actor')->find($id);
        return response()->json(["message" => $movie], 201);
    }

    public function edit(Movie $movie)
    {
        //
    }

    public function update(Request $request, Movie $movie)
    {
        $movie->update([
            "title"=>$request->title,
            "description"=>$request->description,
            "release"=>$request->release,
            "genre_id"=>$request->genre_id,
            "producer_id"=>$request->producer_id,
            "imgpath"=>'storage/images/'.trim($request->title).'.jpeg'
        ]);
        Storage::put('public/images/'.trim($request->title).'.jpeg', base64_decode($request->imgpath));
        return response()->json(["message" => "Movie Edited!"], 201);
    }

    public function destroy($id)
    {
        $movie = Movie::find($id)->delete();
        return response()->json(["message" => "Movie Deleted!"], 201);
    }
}
