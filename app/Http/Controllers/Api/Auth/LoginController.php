<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use UserSeeder;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        $login = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

            if ( !Auth::attempt( $login )) {
                return response()->json(['message' => 'Invalid login credentials.'], 401);
                }

                $accessToken = Auth::user()->createToken('authToken')->accessToken;
                return response()->json(['user' => Auth::user(), 'access_token' => $accessToken]);



    }

    public function register(Request $request)
    {
        $rules = [
            'username' => 'required',
            'email' => 'required|email|unique:tw_usuarios',
            'password' => 'required',
        ];

        $this->validate($request, $rules);

        try {
            $form = $request->all();
            $form['password'] = bcrypt($request->password);
            $form['verified'] = User::USUARIO_NO_VERIFICADO;
            $usuario = User::create($form);
            return response()->json(['data' => $usuario], 201);

        } catch (\Exception $exception) {
           return response()->json(['message' => $exception->getMessage()], 401);
        }

       // return $this->showOne($usuario,201);
    }
}
