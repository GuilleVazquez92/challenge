<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\PlayerType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRequest;
use App\Http\Requests\Players\PlayerTypeStoreRequest;

class PlayerTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $playerTypes = PlayerType::all();

        return response()->json([
            'success' => true,
            'data' => $playerTypes,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(PlayerTypeStoreRequest $request)
    {
        
        $playerType = PlayerType::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $playerType,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PlayerType $playerType)
    {
        return response()->json([
            'success' => true,
            'data' => $playerType,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, PlayerType $playerType)
    {
    
        $playerType->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $playerType,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlayerType $playerType)
    {
        $playerType->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item type deleted successfully',
        ]);
    }
}
