<?php

namespace App\Filament\Resources\BlogCategoryResource\Pages;

use App\Filament\Resources\BlogCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBlogCategory extends ViewRecord
{
    protected static string $resource = BlogCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
