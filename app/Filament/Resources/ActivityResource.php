<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Section;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SectionResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SectionResource\RelationManagers;

class SectionResource extends Resource
{
    protected static ?string $model = Section::class;
    protected static ?string $navigationGroup = 'الهيكل';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';
    protected static ?string $navigationLabel = 'الأنشطة';
    protected static ?string $pluralModelLabel  = 'الأنشطة';
    protected static ?int $navigationSort = 2;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->label('الاسم')
                ->columnSpan(2)
                ->required()
                ->required(),
                TextInput::make('email')
                ->label('البريد الالكتروني')
                ->columnSpan(2)
                ->required()
                ->required(),
                TextInput::make('password')
                ->password()
                ->label('كلمة المرور')
                ->columnSpan(2)
                ->revealable(),
                Select::make('section_id')
                ->relationship('sections','name')
                ->label('أسم اللجان')
                ->placeholder('اختر اللجان المفعلة بالنشاط')
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
                ->label('الاسم'),
                TextColumn::make('email')
                ->copyable()
                ->label('البريد الالكتروني'),
                TextColumn::make('sections_count')
                ->counts('sections')
                ->label('عدد اللجان'),
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
            'index' => Pages\ListSections::route('/'),
            'create' => Pages\CreateSection::route('/create'),
            'edit' => Pages\EditSection::route('/{record}/edit'),
        ];
    }
}
