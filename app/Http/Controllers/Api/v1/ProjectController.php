<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectIdRequest;
use App\Http\Resources\Projects\ProjectsResource;
use App\Models\Log;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Konstantinkotov\jwt\Traits\JWTControllerTrait;

class ProjectController extends Controller
{
    use JWTControllerTrait;

    public function __construct()
    {
        $this->middleware(['jwt.protection']);
    }

    public function index() : JsonResource
    {
        User::query()->where('api_token', $this->token())->firstOrFail();

        return ProjectsResource::collection(Project::all());
    }

    public function clear(ProjectIdRequest $request) : bool
    {
        Log::query()->where('project_id', $request->input('id'))->delete();

        return true;
    }
}
