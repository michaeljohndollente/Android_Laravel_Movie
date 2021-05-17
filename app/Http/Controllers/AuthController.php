<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Exception;

class AuthController extends Controller
{

    public function register (Request $request)
    {
        $newuser = $request->all();     
        $newuser['password'] = Hash::make($newuser['password']);
        $user = User::create($newuser); 

        return response()->json($user);
    }

    public function login(Request $request)
    {
        try {
            $credentials = request(['email', 'password']);
            
            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'status_code' => 500,
                    'message' => 'Unauthorized'
                ]);
            }
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                throw new \Exception('Error in Login');
            }

            $userid = User::orderBy('id')
            ->select('id')
            ->where('email', '=', $request->email)
            ->get();

            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'status_code' => 200,
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user_id' => $userid,
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error to login',
                'error' => $error,
                
            ]);
        }
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

    }

    public function getUserID($email)
    {
        $user = User::orderBy('id')
        ->where('email', '=', $email)
        ->get();
        return response()->json($user);
    }
}