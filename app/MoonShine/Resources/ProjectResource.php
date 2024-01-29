<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Team;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

use Illuminate\Support\Str;
use MoonShine\Fields\Hidden;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

class ProjectResource extends ModelResource
{
    protected string $model = Project::class;

    protected string $title = 'Projects';

    public function query(): Builder
    {
        $query = parent::query();
        $team = TeamMember::where('user_id', auth()->user()->id)->pluck('team_id');
        $query->whereIn('team_id', $team);
        return $query;

    }

    public function fields(): array
    {

        return [
            Block::make([
                ID::make()->sortable(),
                BelongsTo::make('Team', 'team', fn($item) => $item->name),
                Text::make('Name'),
                Text::make('Description'),
                Text::make('DSN', '', fn($item) =>
                    'PEGALOG_ID=' . $item->id
                    )->hideOnForm(),

            ]),
        ];
    }



    public function rules(Model $item): array
    {
        return [];
    }
}
