<?php

namespace App\Filament\Resources\Contacts\Pages;

use App\Filament\Resources\Contacts\ContactResource;
use Filament\Resources\Pages\ListRecords;

class ListContacts extends ListRecords
{
    protected static string $resource = ContactResource::class;

    // Tanpa tombol "Buat" — pesan hanya datang dari form publik.
    protected function getHeaderActions(): array
    {
        return [];
    }
}
