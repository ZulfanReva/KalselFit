<?php

namespace App\Http\Controllers;

// Kelas PHP sederhana yang terlihat seperti controller atau service Laravel.

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\StoreCheckBookingRequest;
use App\Http\Requests\StorePaymentRequest;
use App\Models\SubscribePackage;
use App\Models\SubscribeTransaction;
use App\Services\BookingService;

class BookingController extends Controller
{
    // Instance layanan booking, biasanya disuntikkan melalui dependency injection.
    protected $bookingService;

    // Konstruktor untuk menyuntikkan BookingService.
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    // Menangani tampilan booking untuk paket langganan.
    public function booking(SubscribePackage $subscribePackage)
    {
        // Mendefinisikan tarif pajak tetap.
        $tax = 0.11;

        // Menghitung jumlah total pajak.
        $totalTaxAmount = $tax * $subscribePackage->price;

        // Menghitung total keseluruhan dengan menambahkan harga dan pajak.
        $grandTotalAmount = $subscribePackage->price + $totalTaxAmount;

        // Mengembalikan tampilan dengan paket, total pajak, dan total keseluruhan.
        return view('booking.checkout', compact('subscribePackage', 'totalTaxAmount', 'grandTotalAmount'));
    }

    // Menangani penyimpanan booking setelah validasi (untuk session saja).
    public function bookingStore(SubscribePackage $subscribePackage, StoreBookingRequest $request)
    {
        // Memvalidasi data permintaan yang masuk.
        $validated = $request->validated();

        try {
            // Mencoba menyimpan booking di sesi melalui layanan booking.
            $this->bookingService->storeBookingInSession($subscribePackage, $validated);
        } catch (\Exception $e) {
            // Jika terjadi pengecualian, alihkan kembali dengan pesan kesalahan.
            return redirect()->back()->withErrors(['error' => 'Gagal menyimpan booking. Silakan coba lagi.']);
        }

        // Alihkan ke rute pembayaran saat berhasil.
        return redirect()->route('front.payment');
    }

    // Menampilkan halaman pembayaran.
    public function payment()
    {
        // Mendapatkan data pembayaran dari layanan booking.
        $data = $this->bookingService->payment();

        // Mengembalikan tampilan pembayaran dengan data.
        return view('booking.payment', $data);
    }

    // Menangani pengiriman pembayaran.
    public function paymentStore(StorePaymentRequest $request)
    {
        // Memvalidasi data permintaan pembayaran yang masuk.
        $validated = $request->validated();

        // Memanggil metode pembayaran pada layanan booking dan mendapatkan ID transaksi.
        $bookingTransactionId = $this->bookingService->paymentStore($validated);

        // Memeriksa apakah booking berhasil.
        if ($bookingTransactionId) {
            // Alihkan ke halaman sukses dengan ID transaksi.
            return redirect()->route('front.booking_finished', $bookingTransactionId);
        }

        // Jika pembayaran gagal, alihkan kembali ke halaman indeks dengan kesalahan.
        return redirect()->route('front.index')->withErrors(['error' => 'Pembayaran gagal. Silakan coba lagi.']);
    }

    // Menampilkan halaman booking selesai setelah transaksi berhasil.
    public function bookingFinished(SubscribeTransaction $subscribeTransaction)
    {
        // Mengembalikan tampilan untuk konfirmasi booking, meneruskan data transaksi.
        return view('booking.booking_finished', compact('subscribeTransaction'));
    }

    // Menampilkan halaman untuk mengecek booking.
    public function checkBooking()
    {
        // Mengembalikan tampilan untuk mengecek booking.
        return view('booking.check_booking');
    }

    // Menangani pengiriman untuk mengecek detail booking.
    public function checkBookingDetails(StoreCheckBookingRequest $request)
    {
        // Memvalidasi data permintaan yang masuk untuk mengecek booking.
        $validated = $request->validated();

        // Mendapatkan detail booking dari layanan booking.
        $bookingDetails = $this->bookingService->getBookingDetails($validated);

        // Memeriksa apakah detail booking ditemukan.
        if ($bookingDetails) {
            // Mengembalikan tampilan dengan detail booking.
            return view('booking.check_booking_details', compact('bookingDetails'));
        }

    // Jika tidak ada detail yang ditemukan, alihkan kembali dengan kesalahan.
    return redirect()->route('front.check_booking')->withErrors(['error' => 'Transaksi tidak ditemukan']);
    }
}
