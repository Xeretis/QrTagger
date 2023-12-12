<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Helpers\Filament\Colums\DateTimeDiff;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Pages\Page;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique('users', 'email', ignoreRecord: true),
                Forms\Components\DateTimePicker::make('email_verified_at'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn(string $operation) => $operation === 'create')
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_admin')
                    ->required(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Split::make([
                Section::make([
                    TextEntry::make('name'),
                    TextEntry::make('email'),
                    TextEntry::make('email_verified_at')
                        ->dateTime()
                        ->placeholder('Not verified'),
                    IconEntry::make('is_admin')
                        ->boolean(),
                    TextEntry::make('notes_count')
                        ->badge()
                        ->state(function (User $user) {
                            return $user->notes()->count();
                        }),
                ])->columns()->grow(),
                Section::make([
                    TextEntry::make('created_at')
                        ->dateTime(),
                    TextEntry::make('updated_at')
                        ->dateTime(),
                ])->grow(false),
            ])->from('md')
        ])->columns(false);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->tap(new DateTimeDiff())
                    ->placeholder('Not verified')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\IconColumn::make('is_admin')
                    ->boolean(),
                Tables\Columns\TextColumn::make('notes_count')
                    ->badge()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->tap(new DateTimeDiff())
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->tap(new DateTimeDiff())
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\QueryBuilder::make()->constraints([
                    Tables\Filters\QueryBuilder\Constraints\BooleanConstraint::make('is_admin'),
                    Tables\Filters\QueryBuilder\Constraints\DateConstraint::make('created_at'),
                    Tables\Filters\QueryBuilder\Constraints\DateConstraint::make('updated_at'),
                ])
            ])
            ->filtersFormWidth(MaxWidth::Medium)
            ->actions([
                Tables\Actions\ViewAction::make()->label('Manage')->icon('heroicon-m-wrench-screwdriver')->color('primary'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(function ($query) {
                $query->withCount('notes');
            });
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'manage-notes' => Pages\ManageUserNotes::route('/{record}/manage-notes'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ViewUser::class,
            Pages\EditUser::class,
            Pages\ManageUserNotes::class,
        ]);
    }
}
