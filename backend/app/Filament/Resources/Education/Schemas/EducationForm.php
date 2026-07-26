<?php

namespace App\Filament\Resources\Education\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EducationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Pendidikan')
                    ->columns(2)
                    ->schema([
                        TextInput::make('level')
                            ->label('Jenjang')
                            ->placeholder('Sekolah Menengah Kejuruan')
                            ->required(),
                        TextInput::make('institution')
                            ->label('Institusi')
                            ->placeholder('SMK MARHAS Margahayu')
                            ->required(),
                        TextInput::make('year_start')
                            ->label('Tahun mulai')
                            ->numeric()
                            ->minValue(1950)
                            ->maxValue(2100)
                            ->required(),
                        TextInput::make('year_end')
                            ->label('Tahun selesai')
                            ->numeric()
                            ->minValue(1950)
                            ->maxValue(2100)
                            ->required(),
                        TextInput::make('sort_order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0)
                            ->required(),
                    ]),
            ]);
    }
}
