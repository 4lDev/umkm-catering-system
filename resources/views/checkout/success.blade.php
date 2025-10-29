<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <div class="container mx-auto px-4 py-20 text-center">
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-lg mx-auto">
            <svg class="w-16 h-16 text-green-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>

            <h1 class="text-3xl font-bold text-gray-800 mb-4">
                Pesanan Anda Berhasil Dibuat!
            </h1>
            <p class="text-gray-600 mb-6">
                Terima kasih telah memesan. Kami akan segera menghubungi Anda via WhatsApp untuk konfirmasi pesanan dan pembayaran.
            </p>

            @if (session('order_id'))
                <p class="text-lg font-semibold text-gray-800">
                    Nomor Pesanan Anda: #{{ session('order_id') }}
                </p>
            @endif

            <a href="{{ route('home') }}" class="mt-8 inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                &larr; Kembali ke Homepage
            </a>
        </div>
    </div>

</body>
</html>