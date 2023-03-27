<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    
    protected $table = 'inventories';

    protected $fillable = [
        'player_id', 
        'item_id', 
        'equipped'
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function item()
    {
        return $this->belongsToMany(Item::class);
    }
}
