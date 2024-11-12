<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Branche;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BrancheResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BrancheResource\RelationManagers;

class BrancheResource extends Resource
{
    protected static ?string $model = Branche::class;
    protected static ?string $navigationGroup = 'الهيكل';
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationLabel = 'الفروع';
    protected static ?string $pluralModelLabel  = 'الفروع';
    protected static ?int $navigationSort = 1;
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->label('الاسم')
                ->columnSpan(2)
                ->required(),
                TextInput::make('email')
                ->label('البريد الالكتروني')
                ->columnSpan(2)
                ->required(),
                Select::make('section_id')
                ->relationship('sections','name')
                ->label('أسم النشاط')
                ->placeholder('اختر الانشطة المفعلة بالفرع')
                ->searchable(['name'])
                ->multiple()
                ->preload()
                ->columnSpan(2)
                ->required(),
              
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->searchable()
                ->label('الاسم'),
                TextColumn::make('email')
                ->label('البريد الالكتروني'),
                TextColumn::make('sections_count')
                ->counts('sections')
                ->label('عدد الانشطة'),
         
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label(false),
                Tables\Actions\ViewAction::make()->label(false),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListBranches::route('/'),
            'create' => Pages\CreateBranche::route('/create'),
            'edit' => Pages\EditBranche::route('/{record}/edit'),
        ];
    }
}
