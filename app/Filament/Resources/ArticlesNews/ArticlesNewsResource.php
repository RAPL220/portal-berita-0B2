<?php

namespace App\Filament\Resources\ArticlesNews;

use App\Filament\Resources\ArticlesNews\Pages\CreateArticlesNews;
use App\Filament\Resources\ArticlesNews\Pages\EditArticlesNews;
use App\Filament\Resources\ArticlesNews\Pages\ListArticlesNews;
use App\Filament\Resources\ArticlesNews\Schemas\ArticlesNewsForm;
use App\Filament\Resources\ArticlesNews\Tables\ArticlesNewsTable;
use App\Models\ArticlesNews;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\ToggleColumn;

class ArticlesNewsResource extends Resource
{
    protected static ?string $model = ArticlesNews::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Newspaper;

    protected static ?string $recordTitleAttribute = 'News';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('author_id')
                ->relationship('author', 'name')
                ->required(),
            Select::make('category_id')
                ->relationship('category', 'title')
                ->required(),
            TextInput::make('title')
                ->live(onBlur: true)
                ->afterStateUpdated(function (Set $set, ?string $state) {
                    if (!$state) return;

                    $timestamp = now()->format('YmdHis');
                    $set('slug', Str::slug($state) . '-' . $timestamp);
                })
                ->required(),
            TextInput::make('slug')->readOnly(),
            FileUpload::make('thumbnail')
                ->image()
                ->required()
                ->columnSpanFull(),
            RichEditor::make('content')
                ->required()
                ->columnSpanFull(),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('author.name'),
            TextColumn::make('category.title'),
            TextColumn::make('title'),
            TextColumn::make('slug'),
            ImageColumn::make('thumbnail'),
            ToggleColumn::make('is_featured'),
        ])->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('author_id')
                    ->relationship('author', 'name')
                    ->label('Select Author'),
                SelectFilter::make('category_id')
                    ->relationship('category', 'title')
                    ->label('Select Category'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListArticlesNews::route('/'),
            'create' => CreateArticlesNews::route('/create'),
            'edit' => EditArticlesNews::route('/{record}/edit'),
        ];
    }
}
