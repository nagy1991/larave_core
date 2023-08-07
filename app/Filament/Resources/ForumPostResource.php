<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ForumPostResource\Pages;
use App\Models\ForumPost;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

use Closure;
use Illuminate\Support\Str;

use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;

class ForumPostResource extends Resource
{
    protected static ?string $model = ForumPost::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-alt';

    protected static ?string $navigationGroup = 'Forum';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        $appUrl = env('APP_URL');
        return $form
        ->schema([
            Card::make()->schema([
                TextInput::make('title')
                    ->label(__('post.title'))
                    ->placeholder(__('post.new_post'))
                    ->reactive()
                        ->afterStateUpdated(function (Closure $set, $state) use ($appUrl) {
                            $slug = Str::slug($state);
                            $slugWithUrl = $appUrl . '/forum' . '/' .$slug;
                            $set('slug', $slugWithUrl);
                        })    
                    ->required(),
                RichEditor::make('content')
                    ->columnSpan(2)
                    ->extraInputAttributes(['style' => 'min-height: 350px;'])
                    ->label(__('post.content')),  
            ])
            ->columnSpan(2),
            Card::make()->schema([
                Select::make('is_published')
                    ->label(__('post.is_published'))
                    ->default('published')
                    ->options([
                        'published' => 'Nyilványos',
                        'users' => 'Tagoknak',
                    ]),
                TextInput::make('slug')
                    ->label(__('post.slug'))
                    ->disabled()
                    ->url()
                    ->required(),
                Select::make('author_id')
                    ->label(__('post.author'))
                    ->relationship('author', 'name')
                    ->required()
                    ->default(auth()->user()->id)->preload(),    
                Select::make('category_id')
                    ->label(__('post.category'))
                    ->relationship('category', 'name')
                    ->multiple()
                    ->preload()
                    ->required(),
            ])
            ->columnSpan(1),
        ])
        ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label(__('post.title'))->limit('50')->sortable()->toggleable(),
                TextColumn::make('author.name')->label(__('post.author'))->limit('50')->toggleable(),
                TextColumn::make('category.name')->label(__('post.category'))->limit('50')->toggleable(),
                TextColumn::make('is_published')->label(__('post.is_published'))->limit('50')->toggleable(),
                TextColumn::make('updated_at')->dateTime('Y.m.d')->label(__('permission.updated_at'))->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')->dateTime('Y.m.d')->label(__('permission.created_at'))->sortable()->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListForumPosts::route('/'),
            'create' => Pages\CreateForumPost::route('/create'),
            'view' => Pages\ViewForumPost::route('/view/{record}'),
            'edit' => Pages\EditForumPost::route('/edit/{record}'),
        ];
        
    }
    
    public static function getPluralModelLabel(): string
    {
        return __('post.page_forum_titles');
    }

    public static function getModelLabel(): string
    {
        return __('post.page_forum_address');
    }
}
