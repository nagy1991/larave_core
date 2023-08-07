<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogTagResource\Pages;
use App\Models\BlogTag;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;

class BlogTagResource extends Resource
{
    protected static ?string $model = BlogTag::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationGroup = 'Blog';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                        ->label(__('tag.name'))
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label(__('tag.name'))->limit('50')->sortable()->toggleable(),
                TextColumn::make('updated_at')->dateTime('Y.m.d')->label(__('tag.updated_at'))->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')->dateTime('Y.m.d')->label(__('tag.created_at'))->sortable()->toggleable(),
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
            'index' => Pages\ListBlogTags::route('/'),
            'create' => Pages\CreateBlogTag::route('/create'),
            'view' => Pages\ViewBlogTag::route('/view/{record}'),
            'edit' => Pages\EditBlogTag::route('/edit/{record}'),
        ];
    }
    
    public static function getPluralModelLabel(): string
    {
        return __('tag.page_titles');
    }

    public static function getModelLabel(): string
    {
        return __('tag.page_address');
    }    
}
