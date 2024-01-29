<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\TeamMember;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Team;

use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

class TeamResource extends ModelResource
{
    protected string $model = Team::class;

    protected string $title = 'Teams';

    public function query(): Builder
    {
        $query = parent::query();
        $team = TeamMember::where('user_id', auth()->id())->pluck('team_id');
        $query->where(function ($query) use($team){
            $query->whereIn('id', $team)
                ->orWhere('user_id', auth()->id());
        });

        return $query;
    }

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Name'),
                HasMany::make('Members', 'members',resource: new TeamMemberResource())->creatable()->hideOnIndex(),
            ]),
        ];
    }

    protected function beforeCreating(Model $item): Model
    {
        $item->user_id = auth()->id();
        return $item;
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
