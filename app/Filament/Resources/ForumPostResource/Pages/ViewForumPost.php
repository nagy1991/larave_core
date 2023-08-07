<?php

namespace App\Filament\Resources\ForumPostResource\Pages;

use App\Filament\Resources\ForumPostResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewForumPost extends ViewRecord
{
    protected static string $resource = ForumPostResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
