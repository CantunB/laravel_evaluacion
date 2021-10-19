<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        //return response()->json([ 'valid' => auth()->check() ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $usuarios = User::all();
        return response()->json(['data' => $usuarios], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $rules = [
                'username' => 'required',
                'email' => 'required|email|unique:tw_usuarios',
                'password' => 'required'
            ];

            $this->validate($request, $rules);

            $directory = '/documents/usuarios/';

            if ($request->has('S_FotoPerfilUrl')) {
                $foto = $request->file('S_FotoPerfilUrl');
                $name = $request['username'] . '.' . $foto->getClientOriginalExtension();
                $fotoPath = public_path($directory);
                $foto->move($fotoPath, $name);
            }else{
                $directory = null ;
                $name = null;
            }

            $form = $request->all();
            $form['password'] = bcrypt($request->password);
            $form['S_FotoPerfilUrl'] = $directory . $name ;
            $usuario = User::create($form);
            return response()->json(['data' => $usuario], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return response()->json(['data' => $usuario], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $rules = [
            'username' => 'required',
            'email' => 'email|unique:tw_usuarios,email,'.  $user->id,
            'password' => 'min:6',
            'S_Activo' => 'required',
            'verified' => 'required',
        ];

        $this->validate($request, $rules);

        if($request->has('username')){
            $user->username = $request->username;
        }
        if ($request->has('email') && $user->email != $request->email) {
            $user->verified = User::USUARIO_NO_VERIFICADO;
            $user->verification_token = User::generarVerificationToken();
            $user->email = $request->email;
        }
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }
        $directory = '/documents/usuarios/';

        if ($request->has('S_FotoPerfilUrl')) {
            $archivo = $request->file('S_FotoPerfilUrl');
            $name = $archivo->getClientOriginalName();
            $archivoPath = public_path($directory);
            $archivo->move($archivoPath, $name);

            $user->S_FotoPerfilUrl = $directory . $name;
        }
        else{
            $user->S_FotoPerfilUrl = $user->S_FotoPerfilUrl;
        }

        if (!$user->isDirty()) {
            return response()->json(['data' => 'Se debe especificar al menos un valor diferente'], 422);
        }

        $user->save();

        return response()->json(['data' => $user],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['data' => $user], 200);
    }
}
