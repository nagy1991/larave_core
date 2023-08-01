<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermissionResource\Pages;
use App\Models\Permission;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;

class PermissionResource extends Resource
{
    protected static ?string $model = Permission::class;

    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';

    protected static ?string $navigationGroup = 'Felhasználók';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                        ->label(__('permission.name'))
                        ->required(),
                    Select::make('category')
                        ->label(__('permission.category'))
                        ->required()
                        ->options([
                            'chat' => 'Chat',
                            'bug' => 'Hibabejelentő',
                            'user' => 'Felhasználók',
                            'role' => 'Szerepkörök',
                            'blog' => 'Blog',
                            'forum' => 'Fórum',
                            'setup' => 'Beállítások',
                        ]),
                    Textarea::make('description')
                        ->label(__('permission.description'))
                        ->rows(1)
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label(__('permission.name'))->limit('50')->sortable()->toggleable(),
                TextColumn::make('description')->label(__('permission.description'))->limit('50')->sortable()->toggleable(),
                TextColumn::make('category')->label(__('permission.category'))->sortable()->toggleable(),
                TextColumn::make('updated_at')->dateTime('Y.m.d')->label(__('permission.updated_at'))->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')->dateTime('Y.m.d')->label(__('permission.created_at'))->sortable()->toggleable(),
            ])
            ->defaultSort('category')
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
            'index' => Pages\ListPermissions::route('/'),
            'create' => Pages\CreatePermission::route('/create'),
            'view' => Pages\ViewPermission::route('/view/{record}'),
            'edit' => Pages\EditPermission::route('/edit/{record}'),
        ];
    }
    
    public static function getPluralModelLabel(): string
    {
        return __('permission.page_titles');
    }

    public static function getModelLabel(): string
    {
        return __('permission.page_address');
    }
}
