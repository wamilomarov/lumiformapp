<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class RequestLogIndexDTO extends DataTransferObject
{
    public ?string $endpoint;
    public ?string $method;
    public ?string $ip;
}
