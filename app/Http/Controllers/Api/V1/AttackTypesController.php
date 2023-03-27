<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\AttackType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Attacks\AttackTypeStoreRequest ;
use App\Http\Requests\UpdateRequest ;


class AttackTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attackTypes = AttackType::all();

        return response()->json([
            'success' => true,
            'data' => $attackTypes,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AttackTypeStoreRequest $request)
    {

        $attackType = AttackType::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $attackType,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(AttackType $attackType)
    {
        return response()->json([
            'success' => true,
            'data' => $attackType,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, AttackType $attackType)
    {
      
        $attackType->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $attackType,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AttackType $attackType)
    {
        $attackType->delete();

        return response()->json([
            'success' => true,
            'message' => 'Attack type deleted successfully',
        ]);
    }
}
