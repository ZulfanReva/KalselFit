<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\SubscribePackage;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use App\Models\SubscribeTransaction;
use Filament\Notifications\Notification;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SubscribeTransactionResource\Pages;
use App\Filament\Resources\SubscribeTransactionResource\RelationManagers;

class SubscribeTransactionResource extends Resource
{
    protected static ?string $model = SubscribeTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Product and Price')
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    Forms\Components\Select::make('subscribe_package_id')
                                        ->relationship('subscribePackage', 'name')
                                        ->searchable()
                                        ->preload()
                                        ->required()
                                        ->live()
                                        ->afterStateUpdated(function ($state, callable $set) {
                                            $subscribePackage = SubscribePackage::find($state);
                                            $price = $subscribePackage ? $subscribePackage->price : 0;
                                            $duration = $subscribePackage ? $subscribePackage->duration : 0;
                                            $set('price', $price);
                                            $set('duration', $duration);
                                            $tax = 0.11;
                                            $totalTaxAmount = $tax * $price;
                                            $totalAmount = $price + $totalTaxAmount;
                                            $set('total_amount', number_format($totalAmount, 0, ',', ''));
                                            $set('total_tax_amount', number_format($totalTaxAmount, 0, ',', ''));
                                            $set('started_at', null);
                                            $set('ended_at', null);
                                        })
                                        ->afterStateHydrated(function (callable $get, callable $set, $state) {
                                            $price = 0;
                                            $subscribePackageId = $state;
                                            if ($subscribePackageId) {
                                                $subscribePackage = SubscribePackage::find($subscribePackageId);
                                                $price = $subscribePackage ? $subscribePackage->price : 0;
                                                $set('price', $price);
                                            }
                                            $tax = 0.11;
                                            $totalTaxAmount = $tax * $price;
                                            $set('total_tax_amount', number_format($totalTaxAmount, 0, ',', ''));
                                        }),
                                    Forms\Components\TextInput::make('price')
                                        ->label('Price Subscribe package')
                                        ->required()
                                        ->readOnly()
                                        ->numeric()
                                        ->prefix('IDR'),
                                    Forms\Components\TextInput::make('total_amount')
                                        ->label('Total Pembayaran')
                                        ->required()
                                        ->readOnly()
                                        ->numeric()
                                        ->prefix('IDR'),
                                    Forms\Components\TextInput::make('total_tax_amount')
                                        ->label('Total Pajak')
                                        ->readOnly()
                                        ->required()
                                        ->numeric()
                                        ->prefix('IDR'),
                                    Forms\Components\DatePicker::make('started_at')
                                        ->label('Tanggal Mulai')
                                        ->required()
                                        ->live()
                                        ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                            $duration = $get('duration') ?? 0;
                                            if ($state && $duration) {
                                                $startDate = \Carbon\Carbon::parse($state);
                                                $endDate = $startDate->addDays($duration);
                                                $set('ended_at', $endDate->toDateString());
                                            } else {
                                                $set('ended_at', null);
                                            }
                                        }),
                                    Forms\Components\DatePicker::make('ended_at')
                                        ->label('Tanggal Selesai')
                                        ->required()
                                        ->readOnly(),
                                    Forms\Components\TextInput::make('duration')
                                        ->label('Durasi')
                                        ->readOnly()
                                        ->required()
                                        ->numeric()
                                        ->prefix('Days'),
                                ]),
                        ]),
                    Forms\Components\Wizard\Step::make('Customer Information')
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    Forms\Components\TextInput::make('name')
                                        ->label('Nama Lengkap')
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('phone')
                                        ->label('Nomor Telepon')
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('email')
                                        ->label('Alamat Email')
                                        ->required()
                                        ->maxLength(255),
                                ]),
                        ]),
                    Forms\Components\Wizard\Step::make('Payment Information')
                        ->schema([
                            Forms\Components\TextInput::make('booking_trx_id')
                                ->label('Booking Transaction ID')
                                ->required()
                                ->maxLength(255),
                            ToggleButtons::make('is_paid')
                                ->label('Apakah sudah membayar?')
                                ->boolean()
                                ->grouped()
                                ->icons([
                                    true => 'heroicon-o-pencil',
                                    false => 'heroicon-o-clock',
                                ])
                                ->required(),
                            Forms\Components\FileUpload::make('proof')
                                ->label('Bukti Pembayaran')
                                ->image()
                                ->required(),
                        ]),
                ])
                    ->columnSpan('full') // Full width for the wizard
                    ->columns(1) // Single column layout
                    ->skippable(), // Allow skipping steps
            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('booking_trx_id')
                    ->label('Booking Transaction ID')
                    ->searchable(),

                Tables\Columns\IconColumn::make('is_paid')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->label('Status Payment'),
            ])
            ->filters([
                SelectFilter::make('subscribe_package_id')
                    ->label('Subscribe Package')
                    ->relationship('subscribePackage', 'name'),

                SelectFilter::make('is_paid')
                    ->label('Status Transaction')
                    ->options([
                        true => 'Success',
                        false => 'Pending',
                    ])
                    ->attribute('is_paid')
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->action(function (SubscribeTransaction $record) {
                        $record->is_paid = true;
                        $record->save();

                        // Trigger the custom notification
                        Notification::make()
                            ->title('Transaction Approved')
                            ->success()
                            ->body('The transaction has been successfully approved.')
                            ->send();
                    })
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn(SubscribeTransaction $record) => !$record->is_paid),
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
            'index' => Pages\ListSubscribeTransactions::route('/'),
            'create' => Pages\CreateSubscribeTransaction::route('/create'),
            'edit' => Pages\EditSubscribeTransaction::route('/{record}/edit'),
        ];
    }
}
