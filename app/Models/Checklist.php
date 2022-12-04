<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Form $form
 */
class Checklist extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    public function form(): HasOne
    {
        return $this->hasOne(Form::class);
    }
}
