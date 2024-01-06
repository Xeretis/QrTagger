<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\QrTagResource\Pages;
use App\Filament\Admin\Resources\QrTagResource\RelationManagers;
use App\Helpers\QrTags\Enums\QrTagDataFieldType;
use App\Models\QrTag;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Pages\Page;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QrTagResource extends Resource
{
    protected static ?string $model = QrTag::class;

    protected static ?string $navigationIcon = 'heroicon-o-qr-code';

    public static function getModelLabel(): string
    {
        return 'Tag';
    }

    public static function getNavigationBadge(): ?string
    {
        return QrTag::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Select::make('user')
                    ->relationship('user', 'name')
                    ->preload()
                    ->native(false)
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->maxLength(255)->columnSpan(2),
                Toggle::make('include_personal_information')
                    ->inline(false)
                    ->required(),
                Repeater::make('data')
                    ->schema([
                        TextInput::make('label')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('value')
                            ->required()
                            ->maxLength(255),
                        Select::make('type')
                            ->required()
                            ->selectablePlaceholder(false)
                            ->options(QrTagDataFieldType::class)
                            ->default(QrTagDataFieldType::Text)
                            ->columnSpan(2)
                    ])->columns()->columnSpan(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->wrap()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->since()
                    ->default('Never')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\QueryBuilder::make()->constraints([
                    Tables\Filters\QueryBuilder\Constraints\TextConstraint::make('name'),
                    Tables\Filters\QueryBuilder\Constraints\TextConstraint::make('description'),
                ])
            ])
            ->filtersFormWidth(MaxWidth::Medium)
            ->actions([
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\ViewAction::make()->label('Manage')->icon('heroicon-m-wrench-screwdriver')->color('primary'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(function ($query) {
                $query->with('user');
            });
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Split::make([
                Grid::make([
                    'default' => 1
                ])->schema([
                    Section::make('Tag information')->schema([
                        TextEntry::make('name'),
                        TextEntry::make('description'),
                        IconEntry::make('include_personal_information')->label('Includes personal information')->boolean(),
                    ])->columns(),
                    Section::make('User information')->schema([
                        TextEntry::make('user.name')->label('Name'),
                        TextEntry::make('user.email')->label('Email')->copyable(),
                    ])->columns(),
                    Section::make('Tag data')->schema([
                        RepeatableEntry::make('data')->label('')->schema([
                            TextEntry::make('label'),
                            TextEntry::make('value')->limit(30)->copyable(),
                            TextEntry::make('type')->badge()
                        ])->placeholder('Seems like there is no data set...')->columns(),
                    ]),
                ])->grow(),
                Section::make([
                    TextEntry::make('created_at')
                        ->dateTime(),
                    TextEntry::make('updated_at')
                        ->dateTime(),
                ])->grow(false),
            ])->from('lg')
        ])->columns(false);
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
            'index' => Pages\ListQrTags::route('/'),
            'create' => Pages\CreateQrTag::route('/create'),
            'view' => Pages\ViewQrTag::route('/{record}'),
            'edit' => Pages\EditQrTag::route('/{record}/edit'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ViewQrTag::class,
            Pages\EditQrTag::class,
        ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
