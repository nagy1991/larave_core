<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use Filament\Facades\Filament;

use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;

class CommentResource extends Resource
{
    /*  protected static ?string $model = Spatie Comment Model Comment::class;*/

    protected static ?string $navigationIcon = 'heroicon-o-chat-alt-2';

    protected static ?string $navigationGroup = 'Hozzászólások';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make(name:'original_text')
                        ->label(__('original_text'))
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(name:'commentable.name')
                    ->getStateUsing(function (Comment $record): string {
                        /** @var HasComments @commentable */
                        $commentable = $record->topLevel()->commentable;

                        return $commentable?->commentableName() ?? 'Deleted';
                    })
                    ->url(fn (Comment $record): string => $record->commentUrl())
                    ->openUrlInNewTab(),
                TextColumn::make(name:'commentator.name')
                    ->getStateUsing(function (Comment $record): string {
                        /** @var CanComment @commentator */
                        $commentator = $record->commentator;

                        return $commentator?->commentatorProperties()?->name ?? 'Guest';
                    })
                    ->url(function (Comment $record): ?string {
                        $resource = match ($record->commentator::class) {
                            User::class => UserResource::class,
                        };

                        if (! $resource) {
                            return null;
                        }

                        return $resource::getUrl('edit', ['record' => $record]);
                    }),
                BadgeColumn::make(name:'status')
                    ->getStateUsing(function (Comment $record): string {
                        return $record->isApproved() ? 'Approved' : 'Pending';
                    })
                    ->colors([
                        'success' => 'Approved',
                        'warning' => 'Pending',
                    ]),
                TextColumn::make(name:'created_at')
                    ->dateTime()
                    ->sortable(),   
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make(name:'approve')
                    ->iconButton()
                    ->action(function (Comment $record) {
                        $record->approve();

                        Filament::notify(status: 'sucess', message: 'Approved');
                    })
                    ->requiresConfirmation()
                    ->hidden(fn (Comment $record): bool => $record->isApproved())
                    ->color(color: 'success')
                    ->icon(icon:'heroicon-s-check'),
                Action::make(name:'reject')
                    ->iconButton()
                    ->action(function (Comment $record) {
                        $record->reject();

                        Filament::notify(status: 'sucess', message: 'Rejected');
                    })
                    ->requiresConfirmation()
                    ->visible(fn (Comment $record): bool => $record->isApproved())
                    ->color(color: 'danger')
                    ->icon(icon:'heroicon-s-x'),
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
            'index' => Pages\ListComments::route('/'),
            'view' => Pages\ViewComment::route('/view/{record}'),
            'edit' => Pages\EditComment::route('/edit/{record}'),
        ];
    }
    
    public static function getPluralModelLabel(): string
    {
        return __('comment.page_titles');
    }

    public static function getModelLabel(): string
    {
        return __('comment.page_address');
    }
}
