<?php

namespace App\Observers;

use App\Models\Log;

class LogObserver
{
    public function created(Log $log): void
    {
        $log->created_at = now();
        $log->save();
    }
}
