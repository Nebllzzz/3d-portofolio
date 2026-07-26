<?php

namespace App\Filament\Resources\Profiles\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identitas')
                    ->columns(2)
                    ->schema([
                        TextInput::make('full_name')
                            ->label('Nama lengkap')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('nickname')
                            ->label('Nama panggilan')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('headline')
                            ->label('Headline')
                            ->helperText('Muncul tepat di bawah nama besar di hero.')
                            ->required()
                            ->columnSpanFull(),
                        Textarea::make('bio')
                            ->label('Bio')
                            ->rows(6)
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('Data diri')
                    ->columns(2)
                    ->schema([
                        TextInput::make('birth_place')
                            ->label('Tempat lahir')
                            ->required(),
                        DatePicker::make('birth_date')
                            ->label('Tanggal lahir')
                            ->native(false)
                            ->required(),
                        Textarea::make('address')
                            ->label('Alamat')
                            ->rows(2)
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('phone')
                            ->label('Telepon')
                            ->tel()
                            ->required(),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required(),
                    ]),

                Section::make('Berkas')
                    ->columns(2)
                    ->schema([
                        FileUpload::make('photo_path')
                            ->label('Foto profil')
                            ->image()
                            ->imageEditor()
                            ->directory('profile')
                            ->helperText('Tampil grayscale di section About.'),
                        FileUpload::make('cv_path')
                            ->label('Berkas CV')
                            ->acceptedFileTypes(['application/pdf'])
                            ->directory('cv')
                            ->helperText('Tombol "Unduh CV" baru muncul setelah ini diisi.'),
                    ]),

                Section::make('Tautan sosial')
                    ->schema([
                        Repeater::make('socials')
                            ->hiddenLabel()
                            ->relationship()
                            ->orderColumn('sort_order')
                            ->columns(3)
                            ->schema([
                                TextInput::make('platform')
                                    ->label('Platform')
                                    ->placeholder('github')
                                    ->required(),
                                TextInput::make('label')
                                    ->label('Teks tampil')
                                    ->placeholder('GitHub')
                                    ->required(),
                                TextInput::make('icon')
                                    ->label('Ikon')
                                    ->placeholder('github')
                                    ->required(),
                                TextInput::make('url')
                                    ->label('URL')
                                    ->required()
                                    ->columnSpanFull(),
                            ])
                            ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                            ->collapsible()
                            ->addActionLabel('Tambah tautan'),
                    ]),
            ]);
    }
}
