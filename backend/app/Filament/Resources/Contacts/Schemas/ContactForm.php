<?php

namespace App\Filament\Resources\Contacts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Pesan')
                    ->columns(2)
                    ->schema([
                        // Isi pesan datang dari pengunjung — dibaca, tidak diubah.
                        TextInput::make('name')
                            ->label('Nama')
                            ->disabled(),
                        TextInput::make('email')
                            ->label('Email')
                            ->disabled(),
                        Textarea::make('message')
                            ->label('Isi pesan')
                            ->rows(8)
                            ->disabled()
                            ->columnSpanFull(),
                        Toggle::make('is_read')
                            ->label('Sudah dibaca'),
                    ]),
            ]);
    }
}
