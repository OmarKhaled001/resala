<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Type;
use Filament\Tables;
use App\Models\Section;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SectionResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SectionResource\RelationManagers;
use Filament\Forms\Components\Textarea;

class SectionResource extends Resource
{
    protected static ?string $model = Section::class;
    protected static ?string $navigationGroup = 'الهيكل';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'اللجان';
    protected static ?string $pluralModelLabel  = 'اللجان';
    protected static ?int $navigationSort = 3;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->label('الاسم')
                ->columnSpan(2)
                ->required()
                ->required(),
                
                Select::make('contribution_id')
                ->relationship('contributions','name')
                ->label('أسم المشاركة')
                ->placeholder('اختر المشاركات المفعلة باللجنة')
                ->searchable(['name'])
                ->multiple()
                ->preload()
                ->columnSpan(2)
                ->required()
                ->createOptionForm([
                    TextInput::make('name')
                    ->label('الاسم')
                    ->columnSpan(2)
                    ->required(),
                    Textarea::make('description')
                    ->label('الوصف')
                    ->columnSpan(2)
                    ->required(),
                    Radio::make('value')
                    ->label('نوع المشاركة')
                    ->columnSpan(2)
                    ->options([
                        '1' => 'ميدانية',
                        '2' => 'من المنزل',
                    ]),
                ]),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->label('الاسم'),
         
                TextColumn::make('contributions.name')
                ->limitList(3)
                ->badge()
                ->separator(',')
                ->label('المشاركات'),
                ToggleColumn::make('is_active')
                ->label('تفعيل'),



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
                    Tables\Actions\DeleteBulkAction::make()->label(false),
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
