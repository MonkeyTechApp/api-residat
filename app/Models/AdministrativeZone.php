<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministrativeZone extends Model
{
    use HasFactory, Uuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function region (){
        return $this->belongsTo(Region::class);
    }

    public function mother(){
        return $this->belongsTo(AdministrativeZone::class, 'parent_id');
    }

    public function children(){
        return $this->hasMany(AdministrativeZone::class, 'parent_id');
    }
}
