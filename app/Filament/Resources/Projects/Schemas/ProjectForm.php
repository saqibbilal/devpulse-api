<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Information')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Textarea::make('description')
                            ->required()
                            ->columnSpanFull(),
                        \Filament\Forms\Components\TagsInput::make('tech_stack')
                            ->required(),
                        Grid::make(3)
                            ->schema([
                                TextInput::make('order')
                                    ->required()
                                    ->numeric()
                                    ->default(0),
                                Toggle::make('is_featured')
                                    ->label('Feature on Landing Page')
                                    ->required(),
                            ]),
                    ]),

                Section::make('Project Details')
                    ->relationship('detail')
                    ->schema([
                        Textarea::make('problem_statement')
                            ->required()
                            ->columnSpanFull(),
                        Textarea::make('solution_approach')
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('live_url')
                            ->url()
                            ->columnSpanFull(),
                        \Filament\Forms\Components\Repeater::make('feature_highlights')
                            ->label('Feature highlights')
                            ->simple(TextInput::make('detail'))
                            ->columnSpanFull(),
                        \Filament\Forms\Components\KeyValue::make('repository_links')
                            ->label('Repository links')
                            ->keyLabel('Type')
                            ->valueLabel('URL')
                            ->columnSpanFull(),
                    ]),

                Section::make('Media Gallery')
                    ->schema([
                        \Filament\Forms\Components\SpatieMediaLibraryFileUpload::make('gallery')
                            ->collection('gallery')
                            ->multiple()
                            ->reorderable()
                            ->disk(config('filesystems.default'))
                            ->customProperties([
                                'is_featured' => false,
                            ])
                            ->extraAttributes(['class' => 'media-gallery'])
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
