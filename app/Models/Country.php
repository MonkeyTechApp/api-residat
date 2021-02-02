<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory , Uuids   ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function regions(){
        return $this->hasMany(Region::class);
    }

    public function administrativeZones(){
        return $this->hasManyThrough(AdministrativeZone::class, Region::class);
    }
}
