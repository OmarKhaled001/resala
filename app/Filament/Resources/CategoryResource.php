<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Type;
use Filament\Tables;
use App\Models\Category;
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
use App\Filament\Resources\CategoryResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CategoryResource\RelationManagers;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;
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
                
                Select::make('type_id')
                ->relationship('types','name')
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
                    ->required()
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
         
                TextColumn::make('types.name')
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
