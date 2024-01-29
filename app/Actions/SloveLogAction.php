<?php

namespace App\Actions;

use App\Models\Log;

class SloveLogAction
{
    public function execute($id){
        if($log = Log::find($id)){
            $log->sloved = true;
            $log->save();
        }
    }
}
