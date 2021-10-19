<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Corporate;
use Illuminate\Http\Request;

class CorporateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $corporativos = Corporate::all();
        return response()->json(['data' => $corporativos], 200);
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
            'S_NombreCorto' => 'required',
            'S_NombreCompleto' => 'required',
            'S_DBName' => 'required',
            'S_DBUsuario' => 'required',
            'S_DBPassword' => 'required',
            'S_SystemUrl' => 'required',
            'S_Activo' => 'required',
        ];

        $this->validate($request, $rules);

        $directory = '/documents/corporativo/logos';

            if ($request->has('S_LogoURL')) {
                $foto = $request->file('S_LogoURL');
                $name = $foto->getClientOriginalName(). '.' . $foto->getClientOriginalExtension();
                $fotoPath = public_path($directory);
                $foto->move($fotoPath, $name);
            }else{
                $directory = null ;
                $name = null;
            }

        $corporativo = $request->all();
        $corporativo['S_LogoURL'] = $directory . $name ;

        $corporativo = Corporate::create($corporativo);
        return response()->json(['data' => $corporativo], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $corporativo = Corporate::with(['empresas','contactos','contratos','documentos'])->findOrFail($id);
        return response()->json(['data' => $corporativo], 200);
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
        $corporativo = Corporate::findOrFail($id);
        $rules = [
            'S_NombreCorto' => 'required',
            'S_NombreCompleto' => 'required',
            'S_DBName' => 'required',
            'S_DBUsuario' => 'required',
            'S_DBPassword' => 'required',
            'S_SystemUrl' => 'required',
            'S_Activo' => 'required',
            'tw_usuarios_id' => 'required',
            'FK_Asignado_id' => 'required'
        ];

        $validate = $this->validate($request, $rules);
        $corporativo->update($request->all());
        return response()->json(['data' => $corporativo],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $corporativo = Corporate::findOrFail($id);
        $corporativo->delete();
        return response()->json(['data' => $corporativo], 200);
    }
}
