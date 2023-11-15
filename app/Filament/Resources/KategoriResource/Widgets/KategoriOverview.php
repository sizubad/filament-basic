<?php

namespace App\Filament\Resources\KategoriResource\Widgets;

use App\Models\Kategori;
use Filament\Widgets\Widget;

class KategoriOverview extends Widget
{
    protected static string $view = 'filament.resources.kategori-resource.widgets.kategori-overview';

    public static function getWidgets(): array
{
    return [
        KategoriResource\Widgets\KategoriOverview::class,
    ];
}
}
