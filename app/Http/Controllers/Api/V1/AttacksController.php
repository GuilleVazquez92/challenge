<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Attack;
use App\Models\AttackType;
use App\Models\Player;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Http\Requests\UpdateRequest;
use App\Http\Requests\Attacks\AttackStoreRequest;
use App\Services\AttacksService;
use DB;

class AttacksController extends Controller
{
    private $attacksService;

    public function __construct(AttacksService $attacksService)
    {
        $this->attacksService = $attacksService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attacks = Attack::all();

        return response()->json([
            'success' => true,
            'data' => $attacks,
        ],200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AttackStoreRequest $request)
    {

        $attack_type    = $request->get('attack_type_id');
        $attacker_id    = $request->get('attacker_id');
     
        $defender_id    = $request->get('defender_id');

        if ($attacker_id != $defender_id) {

            $attacker_data           =  $this->attacksService->generatePoints($attacker_id);

            if ($attacker_data['life'] > 0) {

                $defender_data           = $this->attacksService->generatePoints($defender_id);

                $result =  $attacker_data['points'] - $defender_data['points'];


                if ($defender_data['life'] > 0) {


                    $latest_attack  = $this->attacksService->latest_attack($attacker_id);

                    return $this->attacksService->attackCreate($attack_type,$latest_attack, $attacker_data,$defender_data,$request);
                  
                } else {
                    $mesagge = "The enemy is already dead, you can no longer attack him";
                    return $this->attacksService->responseFalse($mesagge);
                }
            } else {
                $mesagge = "You can't launch attacks because you're already dead";
                return $this->attacksService->responseFalse($mesagge);
            }
        } else {
            $mesagge = "You can't attack yourself";
            return $this->attacksService->responseFalse($mesagge);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($attacker_id)
    {
        $attacks = Attack::where('attacker_id', $attacker_id)->get();
        return response()->json([
            'success' => true,
            'data' => $attacks,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Attack $attack)
    {
        $attack->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $attack,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attack $attack)
    {
        $attack->delete();

        return response()->json([
            'success' => true,
            'message' => 'Attack deleted successfully',
        ]);
    }

    public function checkUltiAttack()
    {
       
        $players = Player::where('ulti_active', 1)->get();

        return $players;

       
    }
}
