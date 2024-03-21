<?php

namespace App\Http\Resources\Logs;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LogsResource extends JsonResource
{
    public function toArray(Request $request) : array
    {
        self::withoutWrapping();

        return [
            'id' => $this->id,
            'project_id' => $this->project_id,
            'message' => $this->message,
            'type' => $this->type,
            'context' => $this->context,
            'level' => $this->level,
            'environment' => $this->environment,
            'app_url' => $this->app_url,
            'file' => $this->file,
            'line' => $this->line,
            'request' => $this->request,
            'solved' => $this->sloved,
            'created_at' => $this->created_at?->format('d.m.Y H:i:s'),
            'updated_at' => $this->updated_at?->format('d.m.y H:i:s'),
        ];
    }
}
