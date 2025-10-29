<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katering Dapur Bunda</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <header class="bg-white shadow-md sticky top-0 z-10">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">
                Katering Dapur Bunda
            </h1>
            
            <a href="{{ route('cart.index') }}" class="relative inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-700 hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>

                @php $cart = session()->get('cart', []); @endphp
                @if(count($cart) > 0)
                <span class="absolute top-0 right-0 -mt-2 -mr-2 bg-red-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                    {{ count($cart) }}
                </span>
                @endif
            </a>
        </div>
    </header>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">
            Menu Katering Hari Ini
        </h1>

        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid md:grid-cols-3 gap-6">
            
            @forelse ($products as $product)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">
                            {{ $product->name }}
                        </h2>
                        
                        <p class="text-gray-700 mb-4">
                            {{ $product->description }}
                        </p>
                        
                        <div class="text-3xl font-bold text-blue-600 mb-4">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>

                        <form action="{{ route('cart.store', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                                Pesan Menu Ini
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="md:col-span-3 text-center text-gray-500">
                    <p>Maaf, belum ada menu yang tersedia untuk hari ini.</p>
                </div>
            @endforelse

        </div>
    </div>

</body>
</html>