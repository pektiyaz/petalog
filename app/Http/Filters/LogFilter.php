<?php

namespace App\Http\Filters;

class LogFilter extends QueryFilter
{
    public function id(int $id): void
    {
        $this->builder->where('id', $id);
    }

    public function project_id($project_id): void
    {
        $this->builder->where('project_id', $project_id);
    }
}
