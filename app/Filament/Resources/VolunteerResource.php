<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Volunteer;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
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
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->label('الاسم'),
                TextColumn::make('branche.name')
                ->label('الفرع'),
                TextColumn::make('section.name')
                ->label('النشاط'),
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
