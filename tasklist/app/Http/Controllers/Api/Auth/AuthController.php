<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RegistrationRequest;
use Tymon\JWTAuth\Contracts\Providers\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthController extends Controller
{
    /**
     * Logowanie
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $credentials = $request->only('email', 'password');

        if ($token = auth()->attempt($credentials)) {

            return $this->response($token, auth()->user());
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    /**
     * Rejestracja
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:5',
            'email' => 'required|email:filter|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            // Exclude password_confirmation from the data
            $userData = $request->except('password_confirmation');
            
            $userData['password'] = Hash::make($request->input('password'));

            $user = User::create($userData);

            if ($user) {
                $token = auth()->login($user);
                return $this->response($token, $user);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'wystapil blad'
                ], 500);
            }
        }
    }


    /**
     * metoda zwracająca token jwt
     */
    public function response($token, $user){
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'access_token'=> $token,
            'type' => 'bearer',
        ]);
    }
}
