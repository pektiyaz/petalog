<?php

namespace App\Http\Controllers;

use App\Actions\SloveLogAction;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function slove($id){
        (new SloveLogAction())->execute($id);
        return redirect()->back();
    }
}
