<?php

namespace App\Filament\Resources\ForumCategoryResource\Pages;

use App\Filament\Resources\ForumCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewForumCategory extends ViewRecord
{
    protected static string $resource = ForumCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
