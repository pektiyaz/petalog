<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\TeamMember;

use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Switcher;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

class TeamMemberResource extends ModelResource
{
    protected string $model = TeamMember::class;

    protected string $title = 'TeamMembers';


    public function fields(): array
    {

        return [
            Block::make([
                ID::make()->sortable(),
                BelongsTo::make('Team', 'team', fn($item) => $item->name, resource: new TeamResource()),
                BelongsTo::make('User', 'user',fn($item) => $item->name, resource: new UserResource()),


            ]),
        ];
    }



    public function rules(Model $item): array
    {
        return [];
    }
}
