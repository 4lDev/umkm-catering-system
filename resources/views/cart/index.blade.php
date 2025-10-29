<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">
            Keranjang Belanja Anda
        </h1>

        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-lg p-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Menu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    
                    @php $total = 0; @endphp
                    @forelse ($cart as $id => $details)
                        @php $total += $details['price'] * $details['quantity']; @endphp
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $details['name'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $details['quantity'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form action="{{ route('cart.destroy', $id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus menu ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Keranjang Anda masih kosong.</td>
                        </tr>
                    @endforelse

                </tbody>
                <tfoot>
                    @if (count($cart) > 0)
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-right text-sm font-medium text-gray-900">Total Belanja</td>
                        <td colspan="2" class="px-6 py-4 text-left text-lg font-bold text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</td>
                    </tr>
                    @endif
                </tfoot>
            </table>

            <div class="mt-6 flex justify-between">
                <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800">&larr; Kembali Belanja</a>
                
                @if (count($cart) > 0)
                <a href="{{ route('checkout.index') }}" class="bg-green-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-green-700 transition">
                    Lanjut ke Pembayaran &rarr;
                </a>
                @endif
            </div>

        </div>
    </div>

</body>
</html>
