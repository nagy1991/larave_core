<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogCategoryResource\Pages;
use App\Models\BlogCategory;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;

class BlogCategoryResource extends Resource
{
    protected static ?string $model = BlogCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Blog';

    protected static ?int $navigationSort = 2;

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
            'index' => Pages\ListBlogCategories::route('/'),
            'create' => Pages\CreateBlogCategory::route('/create'),
            'view' => Pages\ViewBlogCategory::route('/view/{record}'),
            'edit' => Pages\EditBlogCategory::route('/edit/{record}'),
        ];
    }
    
    public static function getPluralModelLabel(): string
    {
        return __('categories.page_blog_titles');
    }

    public static function getModelLabel(): string
    {
        return __('categories.page_blog_address');
    }    
}
