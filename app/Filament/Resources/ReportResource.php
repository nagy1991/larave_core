<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Models\Report;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\DateTimePicker;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationIcon = 'heroicon-o-exclamation';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                        ->label(__('report.name'))
                        ->required()
                        ->disabled()
                        ->default(auth()->user()->name)
                        ->maxLength(255),
                    TextInput::make('email')
                        ->label(__('report.email'))
                        ->required()
                        ->disabled()
                        ->default(auth()->user()->email)
                        ->maxLength(255),
                    TextInput::make('devices')
                        ->label(__('report.devices'))
                        ->required()
                        ->disabled()
                        ->default(request()->server('HTTP_USER_AGENT'))
                        ->maxLength(255),
                    Textarea::make('description')
                        ->label(__('report.description'))
                        ->rows(10)
                        ->cols(20)
                        ->required(), 
                    DateTimePicker::make('dateofrepair')
                        ->label(__('report.dateofrepair'))
                        ->default(now())
                        ->displayFormat('Y.m.d H:i'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label(__('report.name'))->limit('50')->sortable()->toggleable(),
                TextColumn::make('email')->label(__('report.email'))->limit('50')->sortable()->toggleable(),
                TextColumn::make('description')->label(__('report.description'))->limit('50')->sortable()->toggleable(),
                IconColumn::make('dateofrepair')->boolean()->label(__('report.status'))->sortable()->toggleable()->default(false),
                TextColumn::make('devices')->label(__('report.devices'))->limit('50')->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->dateTime('Y.m.d')->label(__('report.updated_at'))->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')->dateTime('Y.m.d')->label(__('report.created_at'))->sortable()->toggleable(),
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
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReport::route('/create'),
            'view' => Pages\ViewReport::route('/view/{record}'),
            'edit' => Pages\EditReport::route('/edit/{record}'),
        ];
    }
    
    public static function getPluralModelLabel(): string
    {
        return __('report.page_titles');
    }

    public static function getModelLabel(): string
    {
        return __('report.page_address');
    }
}
