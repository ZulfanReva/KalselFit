<?php

namespace App\Repositories;

use App\Models\SubscribeTransaction;
use App\Repositories\Contracts\BookingRepositoryInterface;
use Illuminate\Support\Facades\Session;

class BookingRepository implements BookingRepositoryInterface
{
    public function createBooking(array $data)
    {
    // Pada varian API ini, penyimpanan booking mungkin dilakukan via HTTP ke service lain.
    // Jadi createBooking di sini akan memanggil API eksternal. Di course mereka
    // mengomentari implementasi langsung karena contoh memakai service lain.
    }

    public function findByTrxIdAndPhoneNumber($bookingTrxId, $phoneNumber)
    {
        return SubscribeTransaction::where('booking_trx_id', $bookingTrxId)
            ->where('phone', $phoneNumber)
            ->first();
    }

    public function saveToSession(array $data)
    {
        Session::put('bookingData', $data);
    }

    public function getBookingDataFromSession()
    {
        return session('bookingData', []);
    }

    public function updateSessionData(array $data)
    {
        $bookingData = session('bookingData', []);
        $bookingData = array_merge($bookingData, $data);
        session(['bookingData' => $bookingData]);
    }

    public function clearSession()
    {
        Session::forget('bookingData');
    }
}
