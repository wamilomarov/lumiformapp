<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property int $checklist_id
 * @property string $uuid
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Checklist $checklist
 * @property Collection|Page[] $pages
 */
class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'checklist_id',
        'uuid',
    ];

    public function checklist(): BelongsTo
    {
        return $this->belongsTo(Checklist::class);
    }

    public function pages(): HasMany
    {
        return $this->hasMany(Page::class);
    }
}
