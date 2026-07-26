<?php

namespace App\Filament\Resources\Experiences\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ExperienceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Pengalaman')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul')
                            ->placeholder('Website Admin & Kasir Caffee')
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('subtitle')
                            ->label('Subjudul')
                            ->placeholder('Menggunakan Framework Laravel'),
                        TextInput::make('date_label')
                            ->label('Keterangan waktu')
                            ->placeholder('23 Oktober 2024')
                            ->required()
                            ->helperText('Timeline diurutkan dari tahun terbesar yang ada di teks ini.'),
                        TextInput::make('sort_order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0)
                            ->required(),
                    ]),

                Section::make('Poin detail')
                    ->description('Satu baris satu poin. Seret untuk mengubah urutan.')
                    ->schema([
                        Repeater::make('points')
                            ->hiddenLabel()
                            ->relationship()
                            ->orderColumn('sort_order')
                            ->simple(
                                TextInput::make('point')
                                    ->hiddenLabel()
                                    ->required(),
                            )
                            ->addActionLabel('Tambah poin'),
                    ]),
            ]);
    }
}
