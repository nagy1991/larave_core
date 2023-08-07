<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ForumCategoryResource\Pages;
use App\Models\ForumCategory;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;

class ForumCategoryResource extends Resource
{
    protected static ?string $model = ForumCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Forum';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                        ->label(__('categories.name'))
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label(__('categories.name'))->limit('50')->sortable()->toggleable(),
                TextColumn::make('updated_at')->dateTime('Y.m.d')->label(__('categories.updated_at'))->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')->dateTime('Y.m.d')->label(__('categories.created_at'))->sortable()->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->iconButton(),
                Tables\Actions\EditAction::make()->iconButton(),
                Tables\Actions\DeleteAction::make()->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListForumCategories::route('/'),
            'create' => Pages\CreateForumCategory::route('/create'),
            'view' => Pages\ViewForumCategory::route('/view/{record}'),
            'edit' => Pages\EditForumCategory::route('/edit/{record}'),
        ];
    }
    
    public static function getPluralModelLabel(): string
    {
        return __('categories.page_forum_titles');
    }

    public static function getModelLabel(): string
    {
        return __('categories.page_forum_address');
    }
}
