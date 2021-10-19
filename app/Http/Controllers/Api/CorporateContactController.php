<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CorporateContact;
use App\Models\CorporateContract;
use Illuminate\Http\Request;

class CorporateContactController extends Controller
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
        $contactos  = CorporateContact::all();
        return response()->json(['data' => $contactos], 200);
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
            'S_Puesto' => 'required',
            'S_Email' => 'required|unique:tw_contactos_corporativos,S_Email',
            'tw_corporativos_id' => 'required'
        ];

        $this->validate($request, $rules);

        $contactos = $request->all();
        $contactos = CorporateContact::create($contactos);
        return response()->json(['data' => $contactos], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contacto = CorporateContact::findOrFail($id);
        return response()->json(['data' => $contacto], 200);
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
        $contacto = CorporateContact::findOrFail($id);
        $rules = [
            'S_Nombre' => 'required',
            'S_Puesto' => 'required',
            'S_Email' => 'required|unique:tw_contactos_corporativos,S_Email' . $contacto->id,
            'tw_corporativos_id' => 'required'
        ];

        $validate = $this->validate($request, $rules);

        $contacto->update($request->all());

        return response()->json(['data' => $contacto],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contacto = CorporateContact::findOrFail($id);
        $contacto->delete();
        return response()->json(['data' => $contacto], 200);
    }
}
