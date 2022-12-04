<?php

namespace App\Http\Controllers;

use App\DTO\RequestLogIndexDTO;
use App\Http\Requests\Logs\RequestLogIndexRequest;
use App\Http\Resources\RequestLogResource;
use App\Models\RequestLog;
use App\Services\RequestLogService;
use Illuminate\Http\Request;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class RequestLogsController extends Controller
{

    public function __construct(protected RequestLogService $requestLogService)
    {
    }

    /**
     * @throws UnknownProperties
     */
    public function index(RequestLogIndexRequest $request)
    {
        $dto = new RequestLogIndexDTO($request->validated());

        $logs = $this->requestLogService->index($dto);

        return RequestLogResource::collection($logs);
    }
}
