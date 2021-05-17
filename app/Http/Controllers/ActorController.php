<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActorController extends Controller
{

    public function index()
    {
        $actor = Actor::with('roles.movie')->get();
        return response()->json(['actor' => $actor], 200);
    }
    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $actor = Actor::create([
            "firstname"=>$request->firstname,
            "lastname"=>$request->lastname,
            "note"=>$request->note,
            "imgpath"=>'storage/images/'.trim($request->firstname).'.jpeg'
        ]);
        Storage::put('public/images/'.trim($request->firstname).'.jpeg', base64_decode($request->imgpath));
        return response()->json([
            "message"=>"Actor has been added."
        ],200);
    }

    public function show($id)
    {
        $actor = Actor::with('roles.movie')->find($id);
        return response()->json(["message" => $actor], 201);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, Actor $actor)
    {
        $actor = $actor->update([
            "firstname"=>$request->firstname,
            "lastname"=>$request->lastname,
            "note"=>$request->note,
            "imgpath"=>'storage/images/'.trim($request->firstname).'.jpeg',
        ]);
        Storage::put('public/images/'.trim($request->firstname).'.jpeg', base64_decode($request->imgpath));
        return response()->json(["message" => "Actor updated"], 200);
    }

    public function destroy($id)
    {
        $actor = Actor::find($id)->delete();
        return response()->json(["message" => "Actor deleted"], 200);
    }
}
