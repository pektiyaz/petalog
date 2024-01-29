<?php

namespace App\Http\Controllers;

use App\Actions\CaptureExceptionAction;
use App\DTO\ExceptionDTO;
use App\Http\Requests\ExceptionCaptureRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index(Request $request){

        (new CaptureExceptionAction())->execute(
            ExceptionDTO::from( $request->all() )
        );
    }
}
