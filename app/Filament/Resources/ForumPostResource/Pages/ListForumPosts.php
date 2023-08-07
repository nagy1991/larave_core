<?php

namespace App\Filament\Resources\ForumPostResource\Pages;

use App\Filament\Resources\ForumPostResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListForumPosts extends ListRecords
{
    protected static string $resource = ForumPostResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
