<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Coops</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">

<div class="container mx-auto px-4 py-6">

    <!-- Header with logo centered + logout right -->
    <div class="relative flex justify-center items-center mb-8">
        <!-- Logo -->
        <img src="{{ asset('images/mantouj-removebg-preview.png') }}" 
             alt="Mantouj Logo" 
             class="h-16 object-contain">

        <!-- Logout button (absolute right) -->
        <form method="POST" action="{{ route('logout') }}" class="absolute right-0">
            @csrf
            <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-lg transition-colors shadow-md">
                Logout
            </button>
        </form>
    </div>

    <!-- Welcome message -->
    <h1 class="text-3xl font-bold mb-6 text-center">
        Welcome, <span class="text-orange-600">{{ auth()->user()->name }}</span>!
    </h1>

    <!-- Search bar -->
    <div class="mb-6 flex justify-center">
        <input type="text" id="coopSearch" placeholder="Search coops..." 
               class="w-full sm:w-1/2 p-2 border rounded-lg focus:outline-none focus:ring focus:ring-orange-300 transition-all duration-300 shadow-sm">
    </div>

    <!-- Coops grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="coopsContainer">
        @forelse ($coops as $coop)
        <a href="{{ route('coops.show', $coop->id) }}" class="transform hover:scale-105 transition-transform">
            <div class="p-1 shadow-md hover:shadow-xl transition-shadow duration-300 rounded-lg">
                <div class="bg-white rounded-lg overflow-hidden flex flex-col items-center p-4">
                    <!-- Coop Logo -->
                    {{-- <img src="{{ $coop->user->image ? asset('images/' . $coop->user->image) : asset('images/default-coop.jpg') }}" 
                         alt="{{ $coop->user->name }}" 
                         class="w-20 h-20 rounded-full object-cover border-2 border-orange-600 mb-4"> --}}

                         <img src="{{ $coop->user && $coop->user->image ? asset('images/' . $coop->user->image) : asset('images/default-coop.jpg') }}">
                    <!-- Coop Info -->
                    <div class="text-center">
                        <h2 class="text-lg font-semibold text-gray-800">{{ $coop->user->name }}</h2>
                        @if($coop->contact)
                            <p class="text-gray-600 text-sm mt-1">Contact: {{ $coop->contact }}</p>
                        @endif
                        <p class="text-gray-600 text-sm mt-1">Products: {{ $coop->products_count ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </a>
        @empty
        <p class="text-center text-gray-500 col-span-3">No coops found. Be the first to add one!</p>
        @endforelse
    </div>

</div>

<script>
    // Smooth search filter
    const searchInput = document.getElementById('coopSearch');
    const coopsContainer = document.getElementById('coopsContainer');

    searchInput.addEventListener('input', () => {
        const filter = searchInput.value.toLowerCase();
        coopsContainer.querySelectorAll('a').forEach(card => {
            const name = card.querySelector('h2').textContent.toLowerCase();
            card.style.display = name.includes(filter) ? '' : 'none';
        });
    });
</script>

</body>
</html>
