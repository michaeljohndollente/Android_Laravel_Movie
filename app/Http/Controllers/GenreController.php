<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{

    public function index()
    {
        $genres = Genre::orderBy('id')->get();
        return response()->json(['genres' => $genres], 201);
    }

    public function create()
    {
        //
    }
 
    public function store(Request $request)
    {
        $genre = Genre::create($request->all());
        return response()->json(["message" => "Genre Added!", 201]);
    }

    public function show(Genre $genre)
    {
        //  
    }

    public function edit(Genre $genre)
    {
        //
    }

    public function update(Request $request, Genre $genre)
    {
        $genre->update($request->all());
        return response()->json(["message" => "Genre updated"], 201);
    }

    public function destroy($id)
    {
        $genre = Genre::find($id)->delete();
        return response()->json(["message" => "Genre Deleted!"], 201);
    }
}
