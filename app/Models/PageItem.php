<?php

namespace App\Models;

use App\Enums\PageItemType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property int $page_id
 * @property int $parent_id
 * @property string $title
 * @property string $uuid
 * @property PageItemType $type
 * @property int $weight
 * @property string $image_id
 * @property string $response_type
 * @property string $response_set
 * @property boolean $multiple_selection
 * @property array $check_conditions_for
 * @property array $categories
 * @property boolean $is_required
 * @property boolean $is_negative
 * @property boolean $is_notes_allowed
 * @property boolean $is_photos_allowed
 * @property boolean $is_issues_allowed
 * @property boolean $is_responded
 * @property boolean $is_repeat
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property PageItem $parent
 * @property Page $page
 * @property Collection|PageItem[] $items
 * @property Collection|PageItem[] $allItems
 */
class PageItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'page_id',
        'parent_id',
        'title',
        'uuid',
        'type',
        'weight',
        'image_id',
        'response_type',
        'response_set',
        'multiple_selection',
        'check_conditions_for',
        'categories',
        'is_required',
        'is_negative',
        'is_notes_allowed',
        'is_photos_allowed',
        'is_issues_allowed',
        'is_responded',
        'is_repeat',
        'value',
    ];

    protected $casts = [
        'weight' => 'integer',
        'is_required' => 'boolean',
        'is_negative' => 'boolean',
        'is_notes_allowed' => 'boolean',
        'is_photos_allowed' => 'boolean',
        'is_issues_allowed' => 'boolean',
        'is_responded' => 'boolean',
        'is_repeat' => 'boolean',
        'check_conditions_for' => 'json',
        'categories' => 'json',
        'type' => PageItemType::class,
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(PageItem::class, 'parent_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(PageItem::class, 'parent_id');
    }

    public function allItems(): HasMany
    {
        return $this->items()->with('allItems');
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
