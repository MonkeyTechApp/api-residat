<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Vector
 * @package App\Models
 *
 * @property int $id
 * @property string $svg
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property-read Collection | AdministrativeZone $administrativeZone
 * @property-read Collection | VectorType $type
 * @property-read Collection | GraphicType $graphicType
 */
class Vector extends Model
{
    use HasFactory , SoftDeletes   ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * @return BelongsTo
     */
    public function administrativeZone(): BelongsTo
    {
        return $this->belongsTo(AdministrativeZone::class);
    }

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(VectorType::class, 'vector_type_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function graphicType() : BelongsTo
    {
        return $this->belongsTo(GraphicType::class, 'graphic_type_id', 'id');
    }


}
