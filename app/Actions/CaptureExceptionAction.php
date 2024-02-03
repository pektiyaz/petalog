<?php

namespace App\Actions;

use App\DTO\ExceptionDTO;
use App\Models\Log;

class CaptureExceptionAction
{
    public function execute(ExceptionDTO $exception){
        $data = $exception->toArray();
        $data['created_at'] = now();
        Log::insert($data);
    }
}
