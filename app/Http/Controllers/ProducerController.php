<?php

namespace App\Http\Controllers;

use App\Models\Producer;
use Illuminate\Http\Request;

class ProducerController extends Controller
{

    public function index()
    {
        $producers = Producer::orderBy('id')->get();
        return response()->json(['producers' => $producers], 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $producer = Producer::create($request->all());
        return response()->json(["message" => "Producer Added!"], 200);
    }

    public function show(Producer $producer)
    {
        //
    }

    public function edit(Producer $producer)
    {
        //
    }

    public function update(Request $request, Producer $producer)
    {
        $producer->update($request->all());
        return response()->json(["message" => "Producer Edited!"], 200);
    }

    public function destroy($id)
    {
        $producer = Producer::find($id)->delete();
        return response()->json(["message" => "Producer Deleted!"], 200);
    }
}
