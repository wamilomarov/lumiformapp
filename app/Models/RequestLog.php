<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $method
 * @property string $endpoint
 * @property int $count
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class RequestLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'endpoint',
        'method',
        'count',
    ];
}
