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
 * @property int $form_id
 * @property string $title
 * @property string $uuid
 * @property boolean $is_collapsed
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Form $form
 * @property Collection|PageItem[] $items
 * @property Collection|PageItem[] $allItems
 */
class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'title',
        'uuid',
        'is_collapsed',
    ];

    protected $casts = [
        'is_collapsed' => 'boolean',
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(PageItem::class);
    }

    public function allItems(): HasMany
    {
        return $this->items()->with('allItems');
    }
}
