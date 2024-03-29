<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Log;
use App\MoonShine\Pages\LogDetail;
use App\MoonShine\Pages\StrackTrace;
use App\MoonShine\Resources\LogResource;
use App\MoonShine\Resources\ProjectResource;
use App\MoonShine\Resources\TeamMemberResource;
use App\MoonShine\Resources\TeamResource;
use App\MoonShine\Resources\UserResource;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function resources(): array
    {
        return [];
    }

    protected function pages(): array
    {
        return [];
    }

    protected function menu(): array
    {
        return [
            MenuItem::make('Teams', new TeamResource()),
            MenuItem::make('Projects', new ProjectResource()),
            MenuItem::make('Logs', new LogResource())->badge(function(){
                return Log::where('sloved', false)->count();
            }),
            MenuItem::make('Users', new UserResource()),

            MenuGroup::make('Hidden', [
                MenuItem::make('User', new TeamMemberResource()),
            ])->canSee(fn()=>false),

        ];
    }

    /**
     * @return array{css: string, colors: array, darkColors: array}
     */
    protected function theme(): array
    {
        return [];
    }
}
