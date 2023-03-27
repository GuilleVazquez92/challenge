<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\ItemType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Items\ItemTypeStoreRequest;
use App\Http\Requests\UpdateRequest;

class ItemTypesController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $itemTypes = ItemType::all();

        return response()->json([
            'success' => true,
            'data' => $itemTypes,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemTypeStoreRequest $request)
    {
        $itemType = ItemType::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $itemType,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ItemType $itemType)
    {
        return response()->json([
            'success' => true,
            'data' => $itemType,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, ItemType $itemType)
    {
        $itemType->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $itemType,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemType $itemType)
    {
        $itemType->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item type deleted successfully',
        ]);
    }

}