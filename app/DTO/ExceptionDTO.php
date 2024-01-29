<?php

namespace App\DTO;

use Spatie\LaravelData\Data;

class ExceptionDTO extends Data
{
    public function __construct(
        public readonly int $project_id,
        public readonly string $message,
        public readonly string $type,
        public readonly string $level,
        public readonly string $environment,
        public readonly string $app_url,
        public readonly string $context,
        public readonly ?string $request,
        public readonly ?string $file,
        public readonly ?int $line
    )
    {}
}
