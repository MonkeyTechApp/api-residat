<?php

namespace App\Models\Traits\Relations;

use App\Models\Vector;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait AdministrativeZoneRelations
{
    /**
     * Relation with vectors
     *
     * @return HasMany
     */
    public function vectors()
    {
        return $this->hasMany(Vector::class);
    }

}
