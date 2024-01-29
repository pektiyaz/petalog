<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

use MoonShine\Fields\Password;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

class UserResource extends ModelResource
{
    protected string $model = User::class;

    protected string $title = 'Users';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Name'),
                Text::make('Email'),
                Password::make('Password')
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
