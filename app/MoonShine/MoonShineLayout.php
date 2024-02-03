<?php

declare(strict_types=1);

namespace App\MoonShine;

use MoonShine\Components\Layout\{Content,
        Flash,
        Footer,
        Header,
        LayoutBlock,
        LayoutBuilder,
        Menu,
        Profile,
        Search,
        Sidebar,
        TopBar};
use MoonShine\Components\When;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        return LayoutBuilder::make([
            TopBar::make([
                Menu::make()->top(),


            ]),
            LayoutBlock::make([

                Flash::make(),
                Header::make(),
                Content::make(),
            ])->customAttributes(['class' => 'layout-page']),
        ]);
    }
}
