<?php

namespace App\Filament\Resources\Projects\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MediaRelationManager extends RelationManager
{
    protected static string $relationship = 'media';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                \Filament\Forms\Components\Toggle::make('custom_properties.is_featured')
                    ->label('Is Featured')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                \Filament\Tables\Columns\ImageColumn::make('url')
                    ->label('Preview')
                    ->getStateUsing(fn ($record) => $record->getUrl()),
                TextColumn::make('name')
                    ->searchable(),
                \Filament\Tables\Columns\ToggleColumn::make('custom_properties.is_featured')
                    ->label('Featured'),
                TextColumn::make('size')
                    ->formatStateUsing(fn ($state) => number_format($state / 1024, 2) . ' KB'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Media is usually handled via the FileUpload on the main form
                // but we can allow adding if needed.
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
