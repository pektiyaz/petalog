<?php

namespace App\Actions;

use App\DTO\ExceptionDTO;
use App\Models\Log;

class CaptureExceptionAction
{
    public function execute(ExceptionDTO $exception){
        Log::insert($exception->toArray());
    }
}
