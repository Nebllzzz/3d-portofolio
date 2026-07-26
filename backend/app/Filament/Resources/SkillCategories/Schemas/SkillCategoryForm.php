<?php

namespace App\Filament\Resources\SkillCategories\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class SkillCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Kategori')
                    ->columns(3)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama kategori')
                            ->placeholder('Backend Teknologi')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug((string) $state))),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        TextInput::make('sort_order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0)
                            ->required(),
                    ]),

                Section::make('Daftar skill')
                    ->description('Seret untuk mengubah urutan tampil di situs.')
                    ->schema([
                        Repeater::make('skills')
                            ->hiddenLabel()
                            ->relationship()
                            ->orderColumn('sort_order')
                            ->columns(3)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama')
                                    ->placeholder('Laravel')
                                    ->required(),
                                TextInput::make('icon')
                                    ->label('Ikon')
                                    ->placeholder('laravel'),
                                Select::make('level')
                                    ->label('Level')
                                    ->options([1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5'])
                                    ->helperText('Opsional, 1–5.'),
                            ])
                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                            ->addActionLabel('Tambah skill'),
                    ]),
            ]);
    }
}
