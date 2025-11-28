<?php

namespace Bmb\PageText\Filament\Resources;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Resource;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Bmb\PageText\Models\PageText;
use Bmb\PageText\Filament\Resources\PageTextResource\Pages;

class PageTextResource extends Resource
{
    protected static ?string $model = PageText::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Einstellungen';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('key')
                    ->unique()
                    ->required()
                    ->maxLength(255),

                TextInput::make('label')
                    ->required()
                    ->maxLength(255),

                RichEditor::make('text')
                    ->label('Text'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')->searchable(),
                TextColumn::make('label')->searchable(),
            ])
            ->defaultSort('key');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPageTexts::route('/'),
            'create' => Pages\CreatePageText::route('/create'),
            'edit' => Pages\EditPageText::route('/{record}/edit'),
        ];
    }
}
