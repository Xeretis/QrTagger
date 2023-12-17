<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\QrTagResource\Pages;
use App\Filament\User\Resources\QrTagResource\RelationManagers;
use App\Helpers\QrTags\Enums\QrTagDataFieldType;
use App\Models\QrTag;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Infolist;
use Filament\Pages\Page;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class QrTagResource extends Resource
{
    protected static ?string $model = QrTag::class;

    protected static ?string $navigationIcon = 'heroicon-o-qr-code';

    public static function getModelLabel(): string
    {
        return 'Tag';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->required()
                    ->maxLength(255),
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
                            ->options(QrTagDataFieldType::class)
                            ->default(QrTagDataFieldType::Text)
                            ->columnSpan(2)
                    ])->columns()
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\TextColumn::make('name')
                        ->weight(FontWeight::Bold)
                        ->limit(40)
                        ->tooltip(function (TextColumn $column): ?string {
                            $state = $column->getState();

                            if (strlen($state) <= $column->getCharacterLimit()) {
                                return null;
                            }

                            return $state;
                        })
                        ->searchable()
                        ->sortable()
                        ->extraAttributes([
                            'class' => 'mb-2',
                        ]),
                    Tables\Columns\TextColumn::make('description')
                        ->wrap()
                        ->limit(40)
                        ->tooltip(function (TextColumn $column): ?string {
                            $state = $column->getState();

                            if (strlen($state) <= $column->getCharacterLimit()) {
                                return null;
                            }

                            return $state;
                        })
                        ->searchable()
                        ->sortable()
                ])
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->filters([
                Tables\Filters\QueryBuilder::make()->constraints([
                    Tables\Filters\QueryBuilder\Constraints\TextConstraint::make('name'),
                    Tables\Filters\QueryBuilder\Constraints\TextConstraint::make('description'),
                ])
            ])
            ->filtersFormWidth(MaxWidth::Medium)
            ->actions([
                Tables\Actions\ViewAction::make()->label('Manage')->icon('heroicon-m-wrench-screwdriver')->color('primary'),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->modifyQueryUsing(function ($query) {
                $query->where('user_id', auth()->id());
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
                    ])->columns(),
                    Section::make('Tag data')->schema([
                        RepeatableEntry::make('data')->label('')->schema([
                            TextEntry::make('label'),
                            TextEntry::make('value'),
                        ])->placeholder('Seems like you didn\'t set any data...')->columns(),
                    ]),
                    Section::make('QR Code')->schema([
                        ViewEntry::make('qr_code')->view('filament.user.infolist.qr-code')
                    ])
                ])->grow(),
                Section::make([
                    TextEntry::make('created_at')
                        ->dateTime(),
                    TextEntry::make('updated_at')
                        ->dateTime(),
                ])->grow(false),
            ])->from('md')
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
}
