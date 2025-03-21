<?php

namespace App\Filament\Resources\PlayerResource\RelationManagers;

use App\Enums\PlatformEnum;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GamesRelationManager extends RelationManager
{
    protected static string $relationship = 'games';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $title = 'Przypisane gry';

    protected static ?string $label = 'grę';

    protected static ?string $pluralLabel = 'gry';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('platform')
                    ->options([
                        'steam' => 'Steam',
                        'kakao' => 'Kakao',
                        'psn' => 'PlayStation Network',
                        'xbox' => 'Xbox',
                        'stadia' => 'Stadia',
                    ])
                    ->required()
                    ->label('Platforma'),
                Forms\Components\TextInput::make('api_player_id')
                    ->label('ID gracza z API')
                    ->placeholder('Wprowadź ID gracza z API gry')
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_active')
                    ->label('Aktywny')
                    ->default(true),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nazwa gry')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('pivot.platform')
                    ->label('Platforma')
                    ->badge(),
                Tables\Columns\TextColumn::make('pivot.api_player_id')
                    ->label('ID gracza z API')
                    ->searchable(),
                Tables\Columns\IconColumn::make('pivot.is_active')
                    ->label('Aktywny')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(fn (Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect(),
                        Forms\Components\Select::make('platform')
                            ->options([
                                'steam' => 'Steam',
                                'kakao' => 'Kakao',
                                'psn' => 'PlayStation Network',
                                'xbox' => 'Xbox',
                                'stadia' => 'Stadia',
                            ])
                            ->required()
                            ->label('Platforma'),
                        Forms\Components\TextInput::make('api_player_id')
                            ->label('ID gracza z API')
                            ->placeholder('Wprowadź ID gracza z API gry')
                            ->maxLength(255),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktywny')
                            ->default(true),
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Edytuj'),
                Tables\Actions\DetachAction::make()
                    ->label('Odłącz'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make()
                        ->label('Odłącz zaznaczone'),
                ]),
            ]);
    }
} 