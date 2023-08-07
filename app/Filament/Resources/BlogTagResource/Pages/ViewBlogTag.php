<?php

namespace App\Filament\Resources\BlogTagResource\Pages;

use App\Filament\Resources\BlogTagResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBlogTag extends ViewRecord
{
    protected static string $resource = BlogTagResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
