<?php

namespace App\Services;

use App\Models\Player;
use App\Models\AttackType;
use App\Models\Attack;

class AttacksService
{
    public function generatePoints($player_id): array
    {
        $player_item = Player::with(['item' => function ($query) {
            $query->wherePivot('equipped', '=', 1);
        }])->find($player_id);

        $points = $player_item->item->sum('attack_points') + $player_item->attack_points;
        $life  = $player_item['life'];

        $return['life'] = $life;
        $return['points'] = $points;
        $return['id']   = $player_id;

        return $return;
    }

    public function power($attack_type)
    {
        $return = AttackType::find($attack_type);

        return $return;
    }

    public function latest_attack($attacker_id)
    {
        $return =  Attack::where('attacker_id', $attacker_id)->latest()->first();

        return $return;
    }

    public function damage($attackPoints, $attackpower, $defensePoints)
    {
        $attackTotal    = $attackPoints * $attackpower;
        $result         =   $attackTotal - $defensePoints;
        $return         = $result > 0 ? $result : 1;
        return $return;
    }

    public function attackCreate($attack_type, $latest_attack, $attacker_data, $defender_data, $request)
    {
        $attack_power   = $this->power($attack_type);
        if ($attack_type == 3) {
            if (isset($latest_attack) and $latest_attack['attack_type_id'] == 1) {

                $damage          = $this->damage($attacker_data['points'], $attack_power['power'], $defender_data['points']);
                $request['damage'] = $damage;
                Player::where('id', $attacker_data['id'])->update(['ulti_active' => 0]);

                $attack = Attack::create($request->all());
            } else {
                $mesagge = "To use the Ulti attack, his last attack must have been a melee attack.";
                return $this->responseFalse($mesagge);
            }
        } else {
            $damage          = $this->damage($attacker_data['points'], $attack_power['power'], $defender_data['points']);
            $request['damage'] = $damage;

            if ($attack_type == 1) {
                Player::where('id', $attacker_data['id'])->update(['ulti_active' => 1]);
            }
            $attack = Attack::create($request->all());
        }

        $life_points_update = $defender_data['life'] - $request['damage'];

        $this->updateLifePoints($life_points_update, $defender_data['id']);

        return response()->json([
            'success' => true,
            'data' => $attack,
        ], 201);
    }

    public function updateLifePoints($life_points_update, $defender_id)
    {
        if ($life_points_update > 0) {
            Player::where('id', $defender_id)->update(['life' => $life_points_update]);
        } else {
            Player::where('id', $defender_id)->update(['life' => 0]);
        }
    }
    public function responseFalse($mesagge)
    {
        return response()->json([
            'success' => false,
            'message' => $mesagge,
        ], 400);
    }
}
