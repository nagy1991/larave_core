<?php

namespace App\Filament\Resources\ForumPostResource\Pages;

use App\Filament\Resources\ForumPostResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateForumPost extends CreateRecord
{
    protected static string $resource = ForumPostResource::class;

    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
