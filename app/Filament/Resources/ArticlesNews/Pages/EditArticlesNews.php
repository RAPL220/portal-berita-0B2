<?php

namespace App\Filament\Resources\ArticlesNews\Pages;

use App\Filament\Resources\ArticlesNews\ArticlesNewsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditArticlesNews extends EditRecord
{
    protected static string $resource = ArticlesNewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
