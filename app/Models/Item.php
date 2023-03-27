<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'item_type_id',
        'defense_points',
        'attack_points'
    ];

    public function itemType()
    {
        return $this->belongsTo(ItemType::class);
    }

    public function player()
    {
        return $this->belongsToMany(Item::class, 'inventories');
    }
}
