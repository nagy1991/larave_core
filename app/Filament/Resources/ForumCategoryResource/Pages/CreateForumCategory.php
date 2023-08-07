<?php

namespace App\Filament\Resources\ForumCategoryResource\Pages;

use App\Filament\Resources\ForumCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateForumCategory extends CreateRecord
{
    protected static string $resource = ForumCategoryResource::class;

    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
