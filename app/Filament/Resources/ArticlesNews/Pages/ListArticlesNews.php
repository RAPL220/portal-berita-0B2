<?php

namespace App\Filament\Resources\ArticlesNews\Pages;

use App\Filament\Resources\ArticlesNews\ArticlesNewsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListArticlesNews extends ListRecords
{
    protected static string $resource = ArticlesNewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
