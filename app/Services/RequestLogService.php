<?php

namespace App\Services;

use App\DTO\RequestLogIndexDTO;
use App\Models\RequestLog;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class RequestLogService
{
    public function store(Request $request): void
    {
        $requestLog = RequestLog::query()
            ->firstOrCreate([
                'method' => $request->method(),
                'endpoint' => $request->path(),
            ], [
                'count' => 0,
            ]);

        $requestLog->increment('count');
    }

    public function index(RequestLogIndexDTO $dto): LengthAwarePaginator
    {
        return RequestLog::query()
            ->when($dto->method, fn(Builder $query) => $query->where('method', $dto->method))
            ->when($dto->endpoint, fn(Builder $query) => $query->where('endpoint', $dto->endpoint))
            ->paginate();
    }
}
