<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attack extends Model
{
    use HasFactory;

    protected $fillable = [
        'attacker_id',
        'defender_id',
        'attack_type_id',
        'damage'
    ];
    
    public function attacker()
    {
        return $this->belongsTo(Player::class);
    }
    
    public function defender()
    {
        return $this->belongsTo(Player::class);
    }
    
    public function attackType()
    {
        return $this->belongsTo(AttackType::class);
    }

    
}
