<?php

namespace App\Filament\Resources\SeasonResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlayerStatisticsRelationManager extends RelationManager
{
    protected static string $relationship = 'playerStatistics';

    protected static ?string $recordTitleAttribute = 'id';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('player_id')
                    ->relationship('player', 'name')
                    ->required(),
                Forms\Components\TextInput::make('kills')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('deaths')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('assists')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('damage_dealt')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('matches_played')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('player.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kills')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deaths')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('assists')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('damage_dealt')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('matches_played')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
} 