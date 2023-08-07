<?php

namespace App\Filament\Resources\ForumPostResource\Pages;

use App\Filament\Resources\ForumPostResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditForumPost extends EditRecord
{
    protected static string $resource = ForumPostResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
