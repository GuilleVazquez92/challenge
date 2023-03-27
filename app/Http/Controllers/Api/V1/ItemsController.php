<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Items\ItemStoreRequest;
use App\Http\Requests\UpdateRequest;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();

        return response()->json([
            'success' => true,
            'data' => $items,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemStoreRequest $request)
    {

        $item = Item::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $item,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return response()->json([
            'success' => true,
            'data' => $item,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Item $item)
    {

        $item->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $item,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item type deleted successfully',
        ]);
    }
}
