<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CorporateCompany;
use Illuminate\Http\Request;

class CorporateCompanyController extends Controller
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
        $empresas = CorporateCompany::all();
        return response()->json(['data' => $empresas], 200);
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
            'S_RazonSocial' => 'required',
            'S_RFC' => 'required',
            'S_Activo' => 'required',
            'tw_corporativos_id' => 'required'
        ];

        $this->validate($request, $rules);

        $empresa = $request->all();
        $empresa = CorporateCompany::create($empresa);
        return response()->json(['data' => $empresa], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empresa = CorporateCompany::findOrFail($id);
        return response()->json(['data' => $empresa], 200);
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
        $empresa = CorporateCompany::findOrFail($id);
        $rules = [
            'S_RazonSocial' => 'required',
            'S_RFC' => 'required',
            'S_Activo' => 'required',
            'tw_corporativos_id' => 'required'
        ];

        $validate = $this->validate($request, $rules);

        $empresa->update($request->all());

        return response()->json(['data' => $empresa],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empresa = CorporateCompany::findOrFail($id);
        $empresa->delete();
        return response()->json(['data' => $empresa], 200);
    }
}
