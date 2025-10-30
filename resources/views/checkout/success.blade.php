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
                Terima kasih telah memesan. Mohon segera konfirmasi pesanan Anda via WhatsApp di bawah ini.
            </p>

            @if (session('order_id'))
                <p class="text-xl font-extrabold text-blue-600 mb-6">
                    Nomor Pesanan Anda: #{{ session('order_id') }}
                </p>
            @endif
            
            @if (session('wa_admin') && session('wa_message_encoded'))
                @php
                    $waLink = "https://wa.me/" . session('wa_admin') . "?text=" . session('wa_message_encoded');
                @endphp
                <a href="{{ $waLink }}" target="_blank" class="w-full inline-flex items-center justify-center bg-green-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-600 transition shadow-lg shadow-green-300/50 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 20 20" fill="currentColor"><path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 4-3-4H4a2 2 0 01-2-2V5z" /></svg>
                    KONFIRMASI VIA WHATSAPP
                </a>
            @endif
            
            <a href="{{ route('home') }}" class="mt-4 inline-block text-gray-600 hover:text-gray-800 transition">
                &larr; Kembali ke Homepage
            </a>
        </div>
    </div>

</body>
</html>