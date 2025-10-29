<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katering Dapur Bunda - Menu Hari Ini</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">

    <header class="bg-white shadow-lg sticky top-0 z-10 border-b border-gray-200">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            
            <div class="flex items-center space-x-6">
                <h1 class="text-2xl font-extrabold text-blue-700 tracking-wider">
                    KATERING BUNDA
                </h1>
                
                <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-blue-600 transition duration-150">
                    Login Admin
                </a>
            </div>
            
            <a href="{{ route('cart.index') }}" class="relative inline-block p-1 rounded-full hover:bg-gray-100 transition duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-700 hover:text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>

                @php $cart = session()->get('cart', []); @endphp
                @if(count($cart) > 0)
                <span class="absolute top-0 right-0 -mt-2 -mr-2 bg-red-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center ring-2 ring-white">
                    {{ count($cart) }}
                </span>
                @endif
            </a>
        </div>
    </header>
    <div class="container mx-auto px-6 py-12">
        
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-10">
            Menu Katering Hari Ini
        </h1>

        @if (session('success'))
            <div class="mb-6 max-w-2xl mx-auto bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-semibold">Sukses!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid md:grid-cols-3 gap-8">
            
            @forelse ($products as $product)
                <div class="bg-white rounded-xl shadow-xl overflow-hidden transform hover:scale-[1.02] transition duration-300 border border-gray-200">
                    
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-1">
                            {{ $product->name }}
                        </h2>
                        
                        <p class="text-gray-600 text-sm mb-4">
                            {{ $product->description }}
                        </p>
                        
                        <div class="text-4xl font-extrabold text-red-600 mb-4">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>

                        <form action="{{ route('cart.store', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-blue-700 text-white px-4 py-3 rounded-xl font-semibold text-lg hover:bg-blue-800 transition shadow-lg shadow-blue-300/50">
                                Pesan Menu Ini
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="md:col-span-3 text-center py-10 text-gray-500">
                    <p class="text-lg">Maaf, belum ada menu yang tersedia untuk hari ini.</p>
                    <p class="text-sm mt-2">Silakan hubungi Admin untuk info lebih lanjut.</p>
                </div>
            @endforelse

        </div>
    </div>

</body>
</html>