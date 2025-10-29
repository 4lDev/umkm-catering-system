<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">
            Checkout Pesanan
        </h1>

        <div class="flex flex-col md:flex-row gap-8">

            <div class="w-full md:w-2/3 bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-2xl font-semibold mb-4">Data Penerima</h2>

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Oops! Ada yang salah:</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="customer_name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="customer_name" id="customer_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="customer_wa" class="block text-sm font-medium text-gray-700">Nomor WhatsApp (Contoh: 0812xxxx)</label>
                        <input type="text" name="customer_wa" id="customer_wa" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="customer_address" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                        <textarea name="customer_address" id="customer_address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required></textarea>
                    </div>

                    <button type="submit" class="w-full bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition text-lg">
                        Buat Pesanan Sekarang
                    </button>
                </form>
            </div>

            <div class="w-full md:w-1/3">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-2xl font-semibold mb-4">Ringkasan Pesanan</h2>
                    
                    @php 
                        $cart = session()->get('cart', []); 
                        $total = 0;
                    @endphp

                    @forelse ($cart as $id => $details)
                        @php $total += $details['price'] * $details['quantity']; @endphp
                        <div class="flex justify-between items-center mb-3">
                            <div>
                                <span class="font-semibold">{{ $details['name'] }}</span>
                                <span class="text-sm text-gray-600">(x{{ $details['quantity'] }})</span>
                            </div>
                            <span class="text-sm text-gray-800">Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</span>
                        </div>
                    @empty
                        <p class="text-gray-500">Keranjang kosong.</p>
                    @endforelse

                    <hr class="my-4">

                    <div class="flex justify-between items-center font-bold text-xl">
                        <span>Total</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <a href="{{ route('cart.index') }}" class="text-blue-600 hover:text-blue-800 mt-4 inline-block">&larr; Edit Keranjang</a>
                </div>
            </div>

        </div>
    </div>

</body>
</html>