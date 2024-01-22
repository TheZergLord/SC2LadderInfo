<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GM extends Model
{
    use HasFactory;
    protected $table = 'gms';
    protected $fillable = ['displayName', 'race', 'clan', 'mmr', 'points', 'wins', 'losses', 'region_id',];

    public function regionName()
    {
        return $this->belongsTo(Region::class, 'region_id', 'region');
    }
}
