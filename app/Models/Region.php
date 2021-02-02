<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory, Uuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description'
    ];

    public function country (){
        return $this->belongsTo(Country::class);
    }

    public function administrativeZones(){
        return $this->hasMany(AdministrativeZone::class);
    }

}
