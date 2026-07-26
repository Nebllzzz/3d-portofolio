<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Project')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug((string) $state))),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Textarea::make('summary')
                            ->label('Ringkasan')
                            ->rows(4)
                            ->required()
                            ->columnSpanFull(),
                        FileUpload::make('cover_path')
                            ->label('Gambar sampul')
                            ->image()
                            ->imageEditor()
                            ->directory('projects')
                            ->columnSpanFull(),
                    ]),

                Section::make('Tautan')
                    ->columns(2)
                    ->schema([
                        TextInput::make('source_url')
                            ->label('Source code')
                            ->url()
                            ->placeholder('https://github.com/…'),
                        TextInput::make('demo_url')
                            ->label('Live demo')
                            ->url()
                            ->helperText('Kosongkan kalau belum ada — tombolnya otomatis disembunyikan.'),
                    ]),

                Section::make('Poin fitur')
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

                Section::make('Tag teknologi')
                    ->schema([
                        Repeater::make('tags')
                            ->hiddenLabel()
                            ->relationship()
                            ->simple(
                                TextInput::make('tag')
                                    ->hiddenLabel()
                                    ->placeholder('Laravel')
                                    ->required(),
                            )
                            ->addActionLabel('Tambah tag'),
                    ]),

                Section::make('Tampilan')
                    ->columns(2)
                    ->schema([
                        Toggle::make('is_featured')
                            ->label('Unggulan')
                            ->helperText('Project unggulan tampil paling atas.'),
                        TextInput::make('sort_order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0)
                            ->required(),
                    ]),
            ]);
    }
}
