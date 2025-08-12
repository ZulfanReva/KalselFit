<?php

namespace App\Filament\Resources;

use App\Models\Gym;
use Filament\Forms;
use Filament\Tables;
use App\Models\Facility;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Fieldset;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\GymResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\GymResource\RelationManagers;
use Filament\Tables\Filters\SelectFilter;

class GymResource extends Resource
{
    protected static ?string $model = Gym::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Main Information')
                    ->schema([
                        // Text input untuk nama
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        // Text area untuk alamat
                        Forms\Components\TextArea::make('address')
                            ->rows(3)
                            ->required()
                            ->maxLength(255),

                        // Upload thumbnail
                        Forms\Components\FileUpload::make('thumbnail')
                            ->image()
                            ->disk('public')
                            ->directory('gyms')
                            ->visibility('public')
                            ->required(),

                        // Repeater untuk multiple gym photos
                        Forms\Components\Repeater::make('gymPhotos')
                            ->relationship('gymPhotos')
                            ->schema([
                                Forms\Components\FileUpload::make('photo')
                                    ->image()
                                    ->disk('public')
                                    ->directory('gym_photos')
                                    ->visibility('public')
                                    ->required(),
                            ]),
                    ]),

                Fieldset::make('Detail Information')
                    ->schema([
                        // Textarea about
                        Forms\Components\Textarea::make('about')
                            ->rows(3)
                            ->required(),

                        // Repeater gym facilities
                        Forms\Components\Repeater::make('gymFacilities')
                            ->relationship('gymFacilities')
                            ->schema([
                                Forms\Components\Select::make('facility_id')
                                    ->label('Gym facility')
                                    ->options(Facility::all()->pluck('name', 'id'))
                                    ->searchable()
                                    ->required(),
                            ]),

                        // Select is popular
                        Forms\Components\Select::make('is_popular')
                            ->options([
                                true => 'Popular',
                                false => 'Not Popular',
                            ])
                            ->required(),

                        // Select city
                        Forms\Components\Select::make('city_id')
                            ->relationship('city', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        // Time picker open time
                        Forms\Components\TimePicker::make('open_time_at')
                            ->required(),

                        // Time picker close time
                        Forms\Components\TimePicker::make('closed_time_at')
                            ->required(),
                    ]),
            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('city.name'),

                Tables\Columns\ImageColumn::make('thumbnail'),

                Tables\Columns\IconColumn::make('is_popular')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->label('Popular'),
            ])
            ->filters([
                //
                SelectFilter::make('city_id')
                    ->label('City')
                    ->relationship('city', 'name'),
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
            'index' => Pages\ListGyms::route('/'),
            'create' => Pages\CreateGym::route('/create'),
            'edit' => Pages\EditGym::route('/{record}/edit'),
        ];
    }
}
