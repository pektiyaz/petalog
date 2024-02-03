<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Project;
use App\Models\TeamMember;
use App\MoonShine\Pages\LogDetail;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Log;

use MoonShine\ActionButtons\ActionButton;
use MoonShine\Enums\ClickAction;
use MoonShine\Fields\Date;
use MoonShine\Fields\DateRange;
use MoonShine\Fields\Enum;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Pages\Crud\FormPage;
use MoonShine\Pages\Crud\IndexPage;
use MoonShine\QueryTags\QueryTag;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

class LogResource extends ModelResource
{
    protected string $model = Log::class;

    protected string $title = 'Logs';
    public function getActiveActions(): array
    {
        return [ 'view',  'delete', 'massDelete'];
    }

    protected ?ClickAction $clickAction = ClickAction::DETAIL;

    public function query(): Builder
    {
        $query  = parent::query();
        $team_ids = TeamMember::where('user_id', auth()->user()->id)->pluck('team_id');
        $projects = Project::whereIn('team_id', $team_ids)->pluck('id');
        $query->whereIn('project_id', $projects);
        return $query;
    }


    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                BelongsTo::make('Project', 'project', fn($item) => $item->name ),
                Text::make('Message','message'),
                Text::make('Level','level'),
                Text::make('Type','type'),
                Text::make('Context','context', fn($item) => $item->type == 'log' ? $item->context : '...'),
                Text::make('Request', 'request'),
                Text::make('Environment','environment'),
                Text::make('File','file'),
                Text::make('Line','line'),
                Text::make('App Url','app_url'),
                Text::make('Date','created_at'),
            ]),
        ];
    }


    public function queryTags(): array
    {

        $items = Project::query()->with(['logs'])->get();
        $data = [];
        foreach($items as $project){
            $count = $project->logs->where('sloved', false)->count();
            $data[] = QueryTag::make($project->name. " ($count) ", function($query) use ($project){
                $query->where('project_id', $project->id);
                return $query;
            });
        }
        return $data;
    }

    public function rules(Model $item): array
    {
        return [];
    }

    public function buttons(): array
    {
        return [
            ActionButton::make(
                label: 'Sloved',
                url: fn($item) => '/log/slove/'.$item->id
            ),
        ];
    }
    public function filters(): array {
        return [
                Enum::make('Level', 'level')->options([
                    '' => 'Unselected',
                    'debug' => 'Debug',
                    'info' => 'Info',
                    'warning' => 'Warning',
                    'error' => 'Error'
                ]),
                Enum::make('Environment', 'environment')->options([
                    '' => 'Unselected',
                    'local' => 'Local',
                    'production' => 'Production'
                ]),
                Enum::make('Type', 'type')->options([
                    '' => 'Unselected',
                    'log' => 'Log',
                    'exception' => 'Exception']),
                DateRange::make('created_at'),
        ];
    }

}
