<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pesanan') }} #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Sukses!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold mb-2">Update Status Pesanan</h3>
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="flex items-center gap-4">
                                <select name="status" class="rounded-md border-gray-300 shadow-sm">
                                    <option value="pending" @if($order->status == 'pending') selected @endif>Pending</option>
                                    <option value="processing" @if($order->status == 'processing') selected @endif>Processing (Diproses)</option>
                                    <option value="completed" @if($order->status == 'completed') selected @endif>Completed (Selesai)</option>
                                    <option value="cancelled" @if($order->status == 'cancelled') selected @endif>Cancelled (Dibatalkan)</option>
                                </select>
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                    <h3 class="text-lg font-semibold mb-4">Data Pelanggan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <strong class="block text-sm text-gray-500">Nama:</strong>
                            <span>{{ $order->customer_name }}</span>
                        </div>
                        <div>
                            <strong class="block text-sm text-gray-500">No. WhatsApp:</strong>
                            <span>{{ $order->customer_wa }}</span>
                        </div>

                        <div class="col-span-2">
                            <strong class="block text-sm text-gray-500">Metode Pengambilan:</strong>
                            @if ($order->delivery_method == 'delivery')
                                <span class="text-sm font-semibold text-blue-700">Diantar (Delivery)</span>
                            @else
                                <span class="text-sm font-semibold text-green-700">Ambil Sendiri (Pickup)</span>
                            @endif
                        </div>

                        <div class="col-span-2">
                            <strong class="block text-sm text-gray-500">Metode Pembayaran:</strong>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-sm font-semibold">
                                    {{ $order->payment_method == 'transfer' ? 'Transfer Bank (Manual)' : 'Bayar di Tempat (COD)' }}
                                </span>
                                
                                @if ($order->payment_status == 'unpaid')
                                    <span class-="px-2 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Belum Lunas
                                    </span>
                                @else
                                    <span class-="px-2 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Lunas
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-span-2">
                            <strong class="block text-sm text-gray-500">Alamat:</strong>
                            <p>{{ $order->customer_address }}</p>
                        </div>
                    </div>

                    <hr class="my-6">

                    <h3 class="text-lg font-semibold mb-4">Item Pesanan</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Menu</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($order->orderItems as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->product_name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">x {{ $item->quantity }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="3" class="px-6 py-3 text-right text-sm font-medium text-gray-900">TOTAL PESANAN</td>
                                    <td class="px-6 py-3 text-right text-lg font-bold text-gray-900">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="mt-8">
                        <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:text-blue-800">&larr; Kembali ke Daftar Pesanan</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>