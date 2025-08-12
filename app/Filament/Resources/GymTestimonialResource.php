<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GymTestimonialResource\Pages;
use App\Filament\Resources\GymTestimonialResource\RelationManagers;
use App\Models\GymTestimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GymTestimonialResource extends Resource
{
    protected static ?string $model = GymTestimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('occupation')
                    ->required()
                    ->maxLength(255),

                Forms\Components\FileUpload::make('photo')
                    ->image()
                    ->disk('public')
                    ->directory('gyms_testimonial')
                    ->visibility('public')
                    ->imagePreviewHeight('150') // atur tinggi preview
                    ->loadingIndicatorPosition('left')
                    ->panelLayout('compact')
                    ->imageEditor() // optional: aktifkan editor gambar
                    ->previewable(true)
                    ->downloadable()
                    ->required(),

                Forms\Components\Select::make('gym_id')
                    ->relationship('gym', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\Textarea::make('message')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\ImageColumn::make('photo'),

                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('occupation'),

                Tables\Columns\TextColumn::make('gym.name')
                    ->label('Gym Name'),

                Tables\Columns\ImageColumn::make('gym.thumbnail')
                ->label('Gym Thumbnail'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListGymTestimonials::route('/'),
            'create' => Pages\CreateGymTestimonial::route('/create'),
            'edit' => Pages\EditGymTestimonial::route('/{record}/edit'),
        ];
    }
}
