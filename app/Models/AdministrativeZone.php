<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AdministrativeZone
 *
 * @property int $id
 * @property string $name
 * @property string $tag_name
 * @property int $level
 * @property bool $active
 * @property-read Collection|Vector[] $vectors
 * @property-read Collection|MapKeys[] $mapKeys
 *
 */
class AdministrativeZone extends Model
{
    use HasFactory, Uuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @return HasMany
     */
    public function vectors () : HasMany{
        return $this->hasMany(Vector::class);
    }

    /**
     * @return HasMany
     */
    public function mapKeys() : HasMany{
        return $this->hasMany(MapKeys::class);
    }

    /**
     * @return BelongsTo
     */
    public function mother() : BelongsTo
    {
        return $this->belongsTo(AdministrativeZone::class, 'parent_id');
    }

    /**
     * @return HasMany
     */
    public function children() : HasMany{
        return $this->hasMany(AdministrativeZone::class, 'parent_id');
    }
}
