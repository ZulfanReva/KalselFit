<?php

namespace App\Repositories;

use App\Models\SubscribeTransaction;
use App\Repositories\Contracts\BookingRepositoryInterface;
use Illuminate\Support\Facades\Session;

class BookingRepository implements BookingRepositoryInterface
{
    // Repository ini bertugas sebagai lapisan akses data untuk booking (SubscribeTransaction).
    // Filosofi: pisahkan logika penyimpanan/ambil data dari controller agar controller tetap tipis.
    // Analogi: repository = "petugas arsip" yang tahu cara menyimpan dan mengambil berkas.
    public function createBooking(array $data)
    {
        return SubscribeTransaction::create($data);
    }

    public function findByTrxIdAndPhoneNumber($bookingTrxId, $phoneNumber)
    {
        return SubscribeTransaction::where('booking_trx_id', $bookingTrxId)
            ->where('phone', $phoneNumber)
            ->first();
    }

    public function saveToSession(array $data)
    {
    // Simpan data booking sementara ke session (mis. multi-step form).
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
    // Gabungkan perubahan kecil ke session tanpa menimpa seluruh object.
    session(['bookingData' => $bookingData]);
    }

    public function clearSession()
    {
        Session::forget('bookingData');
    }
}
