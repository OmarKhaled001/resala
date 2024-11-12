<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Volunteer;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\VolunteerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\VolunteerResource\RelationManagers;

class VolunteerResource extends Resource
{
    protected static ?string $model = Volunteer::class;

    protected static ?string $navigationGroup = 'المتطوعين';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'المتطوعين';
    protected static ?string $pluralModelLabel  = 'المتطوعين';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                
                Textarea::make('notes')
                    ->maxLength(1000),
                
                Select::make('branch_id')
                    ->relationship('branch', 'name')
                    ->required(),
                
                Select::make('section_id')
                    ->relationship('section', 'name')
                    ->required(),
                
                Select::make('activity_id')
                    ->relationship('activity', 'name')
                    ->required(),
                
                TextInput::make('phone')
                    ->tel()
                    ->maxLength(15),
                
                Select::make('gender')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ])
                    ->required(),
                
                DatePicker::make('birth_date')
                    ->label('Birth Date'),
                
                DatePicker::make('vol_date')
                    ->label('Volunteer Date')
                    ->required(),
                
                Textarea::make('address')
                    ->maxLength(500),
                
                Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])
                    ->required(),
                
                Select::make('type')
                    ->options([
                        'full-time' => 'Full-Time',
                        'part-time' => 'Part-Time',
                    ])
                    ->required(),
                
                TextInput::make('email')
                    ->email()
                    ->maxLength(255)
                    ->required(),
                
                TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255),
                
                Toggle::make('t-shirt')
                    ->label('Has T-Shirt')
                    ->inline(false),
                
                Toggle::make('mine_camp')
                    ->label('Mine Camp')
                    ->inline(false),
                
                Toggle::make('camp_48')
                    ->label('Camp 48')
                    ->inline(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->label('الاسم'),
                TextColumn::make('branch.name')
                ->label('الفرع'),
                TextColumn::make('activity.name')
                ->label('النشاط'),
                TextColumn::make('section.name')
                ->label('اللجنة')->toggledHiddenByDefault(true),
                TextColumn::make('phone')
                ->label('رقم الهاتف')
                ->searchable()
                ->copyable(),
                TextColumn::make('status')
                ->label('التصنيف')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'شبل' => 'warning',
                    'داخل المتابعة' => 'warning',
                    'مشروع مسئول' => 'success',
                    'مسئول' => 'success',
                    'خارج المتابعة' => 'danger',
                })
                ->sortable(),
                ToggleColumn::make('ashbal')
                ->label('أشبال'),
            ])
            ->filters([
                // SelectFilter::make('branche.name')
                // ->relationship('branche','name')
                // ->label('الفرع')
                // ->placeholder('اختر الفرع')
                // ->preload()
                // ->multiple(),
                // SelectFilter::make('section.name')
                // ->relationship('section','name')
                // ->label('النشاط')
                // ->preload()
                // ->placeholder('اختر النشاط')
                // ->multiple(),
                SelectFilter::make('status')
                ->options([
                    'مسئول' => 'مسئول',
                    'مشروع مسئول' => 'مشروع مسئول',
                    'داخل المتابعة' => 'داخل المتابعة',
                    'خارج المتابعة' => 'خارج المتابعة',
                ])->label('التصنيف')
                ->placeholder('اختر التصنيف')
                ->multiple(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label(false),
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
            'index' => Pages\ListVolunteers::route('/'),
            'create' => Pages\CreateVolunteer::route('/create'),
            'edit' => Pages\EditVolunteer::route('/{record}/edit'),
        ];
    }
}
