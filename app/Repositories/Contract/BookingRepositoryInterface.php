<?php

namespace App\Repositories\Contract;

interface BookingRepositoryInterface
{
    // Interface ini mendefinisikan kontrak repository untuk booking.
    // Filosofi: controller/service bergantung pada interface, bukan implementasi.
    // Ini memudahkan swapping implementasi (mis. DB vs API) dan testing (mocking).
    public function createBooking(array $data);

    public function findByTrxIdAndPhoneNumber($bookingTrxId, $phoneNumber);

    public function saveToSession(array $data);

    public function updateSessionData(array $data);

    public function getBookingDataFromSession();

    public function clearSession();
}
