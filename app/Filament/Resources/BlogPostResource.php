<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Models\BlogPost;
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
//use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
//use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;

class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-alt';

    protected static ?string $navigationGroup = 'Blog';

    protected static ?int $navigationSort = 1;

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
                            $slugWithUrl = $appUrl . '/blog' . '/' .$slug;
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
                        'private' => 'Magán',
                    ]),
                DateTimePicker::make('published_at')
                    ->label(__('post.published_at'))
                    ->minDate(now())
                    ->default(now())
                    ->displayFormat('Y.m.d H:i'),   
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
                Select::make('tag_id')
                    ->label(__('post.tag'))
                    ->relationship('tags', 'name')
                    ->multiple()
                    ->preload()
                /*FileUpload::make('attachment')
                    ->imagePreviewHeight('250')
                    ->loadingIndicatorPosition('left')
                    ->panelAspectRatio('2:1')
                    ->panelLayout('integrated')
                    ->removeUploadedFileButtonPosition('right')
                    ->uploadButtonPosition('left')
                    ->uploadProgressIndicatorPosition('left')
                */
                //SpatieMediaLibraryFileUpload::make('thumbnail')->collection('posts')->label(__('post.thumbnail')),
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
                TextColumn::make('tags.name')->label(__('post.tag'))->limit('50')->toggleable(),
                TextColumn::make('published_at')->dateTime('Y.m.d H:i')->label(__('post.published_at'))->sortable()->toggleable(),
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
            'index' => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'view' => Pages\ViewBlogPost::route('/view/{record}'),
            'edit' => Pages\EditBlogPost::route('/edit/{record}'),
        ];
    }
    
    public static function getPluralModelLabel(): string
    {
        return __('post.page_blog_titles');
    }

    public static function getModelLabel(): string
    {
        return __('post.page_blog_address');
    }
}
