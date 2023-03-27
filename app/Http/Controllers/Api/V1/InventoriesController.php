<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Inventory;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Inventories\InventoryStoreRequest;
use App\Http\Requests\UpdateRequest;
use DB;

class InventoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories = Inventory::all();

        return response()->json([
            'success' => true,
            'data' => $inventories,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(InventoryStoreRequest $request)
    {
        if ($request['equipped'] == 1) {
            $request['equipped'] = 0;
        }
        $inventory = Inventory::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $inventory,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($player_id)
    {
        $inventories = Inventory::where('player_id', $player_id)->get();
        return response()->json([
            'success' => true,
            'data' => $inventories,
        ]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Inventory $inventory)
    {
        if ($request['equipped'] == 1) {
            $item       = Item::find($request['item_id']);
            $item_type  = $item->item_type_id;

            Inventory::join('items', 'inventories.item_id', '=', 'items.id')
                ->where('inventories.player_id', $request['player_id'])
                ->where('items.item_type_id', $item_type)
                ->update(['inventories.equipped' => 0]);

            $inventory->update($request->all());
        } else {
            $inventory->update($request->all());
        }
        return response()->json([
            'success' => true,
            'data' => $inventory,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();

        return response()->json([
            'success' => true,
            'message' => 'Inventorytype deleted successfully',
        ]);
    }
}
