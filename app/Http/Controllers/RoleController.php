<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('actor', 'movie')->get();
        return response()->json(['roles' => $roles], 201);

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $role = Role::create($request->all());
        return response()->json(["message" => "Role Added", 201]);
    }

    public function show($id)
    {
        $role = Role::with('actor', 'movie')->find($id);
        return response()->json(["message" => $role], 201);
    }

    public function edit(Role $role)
    {
        //
    }

    public function update(Request $request, Role $role)
    {
        $role->update($request->all());
        return response()->json(["message" => "Role updated"], 200);
    }

    public function destroy($id)
    {
        $role = Role::find($id)->delete();
        return response()->json(["message" => "Role Deleted!"], 201);
    }
}
