<?php

namespace App\Http\Resources\Projects;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectsResource extends JsonResource
{
    public function toArray(Request $request) : array
    {
        self::withoutWrapping();

        return [
            'title' => $this->name,
            'description' => $this->description
        ];
    }
}
