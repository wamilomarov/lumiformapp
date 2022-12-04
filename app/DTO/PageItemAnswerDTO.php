<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class PageItemAnswerDTO extends DataTransferObject
{
    public string $uuid;
    public string $answer;
}
