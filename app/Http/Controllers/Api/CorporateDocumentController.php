<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CorporateDocument;
use Illuminate\Http\Request;

class CorporateDocumentController extends Controller
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
        $documento  = CorporateDocument::all();
        return response()->json(['data' => $documento], 200);
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
            'tw_corporativos_id' => 'required',
            'tw_documentos_id' => 'required',
        ];

        $this->validate($request, $rules);

        $directory = '/documents/documentos_corporativos/';

        if ($request->has('S_ArchivoUrl')) {
            $foto = $request->file('S_ArchivoUrl');
            $name = $foto->getClientOriginalName() . '.' . $foto->getClientOriginalExtension();
            $fotoPath = public_path($directory);
            $foto->move($fotoPath, $name);
        }else{
            $directory = null ;
            $name = null;
        }

        $documento = $request->all();
        $documento['S_ArchivoUrl'] = $directory . $name ;
        $documento = CorporateDocument::create($documento);
        return response()->json(['data' => $documento], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $documento = CorporateDocument::findOrFail($id);
        return response()->json(['data' => $documento], 200);
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
        $rules = [
            'tw_corporativos_id' => 'required',
            'tw_documentos_id' => 'required',
        ];

        $this->validate($request, $rules);

        $corporativo = CorporateDocument::findOrFail($id);

        $directory = '/documents/documentos_corporativos/';

        if ($request->has('S_ArchivoUrl')) {
            $archivo = $request->file('S_ArchivoUrl');
            $name = $archivo->getClientOriginalName();
            $archivoPath = public_path($directory);
            $archivo->move($archivoPath, $name);

            $file = $directory . $name;
        }
        else{
            $file = $corporativo->S_ArchivoUrl;
        }
        $documento = $request->all();
        $documento['S_ArchivoUrl'] = $file;
        $corporativo->update($documento);
        return response()->json(['data' => $documento],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $documento = CorporateDocument::findOrFail($id);
        $documento->delete();
        return response()->json(['data' => $documento], 200);
    }
}
