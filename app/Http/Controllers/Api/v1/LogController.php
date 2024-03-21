<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Filters\LogFilter;
use App\Http\Requests\LogIdRequest;
use App\Http\Resources\Logs\LogsResource;
use App\Models\Log;
use Illuminate\Http\Resources\Json\JsonResource;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware(['jwt.protection']);
    }

    public function index(LogFilter $filters): JsonResource
    {
        return LogsResource::collection(Log::filter($filters)->get());
    }

    public function show(LogIdRequest $request): JsonResource
    {
        return (new LogsResource(Log::find($request->input('id'))));
    }

    public function solve(LogIdRequest $request): bool
    {
        Log::query()->where('id', $request->input('id'))->update(['sloved' => 1]);

        return true;
    }

    public function delete(LogIdRequest $request): bool
    {
        Log::query()->where('id', $request->input('id'))->delete();

        return true;
    }
}
