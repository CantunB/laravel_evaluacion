<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
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
        $documentos = Document::all();
        return response()->json(['data' => $documentos ], 200);
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
            'S_Nombre' => 'required',
            'N_Obligatorio' => 'required',
        ];

        $this->validate($request, $rules);

        $documento = $request->all();
        $documento = Document::create($documento);
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
        $documento = Document::with(['doc_cor'])->findOrFail($id);
        return response()->json(['data' => $documento ], 200);
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
        $documento = Document::findOrFail($id);
        $rules = [
            'S_Nombre' => 'required',
            'N_Obligatorio' => 'required',
        ];

        $validate = $this->validate($request, $rules);
        $documento->update($request->all());
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
        $documento = Document::findOrFail($id);
        $documento->delete();
        return response()->json(['data' => $documento], 200);
    }
}
