<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CorporateContract;
use Illuminate\Http\Request;

class CorporateContractController extends Controller
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
        $contratos  = CorporateContract::all();
        return response()->json(['data' => $contratos], 200);
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
            'D_FechaFin' => 'required',
            'tw_corporativos_id' => 'required'
        ];

        $this->validate($request, $rules);

        $contratos = $request->all();
        $contratos = CorporateContract::create($contratos);
        return response()->json(['data' => $contratos], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contratos = CorporateContract::findOrFail($id);
        return response()->json(['data' => $contratos], 200);
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
        $contratos = CorporateContract::findOrFail($id);
        $rules = [
            'D_FechaFin' => 'required',
            'tw_corporativos_id' => 'required'
        ];

        $validate = $this->validate($request, $rules);
        $contratos->update($request->all());

        return response()->json(['data' => $contratos],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contratos = CorporateContract::findOrFail($id);
        $contratos->delete();
        return response()->json(['data' => $contratos], 200);
    }
}
