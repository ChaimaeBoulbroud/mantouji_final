<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $coop->user->name }}'s Products</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div class="container mx-auto px-4 py-8">

    <!-- Breadcrumb -->
    <nav class="text-gray-600 mb-6 text-sm">
        <a href="{{ route('home') }}" class="hover:underline">Home</a> &gt;
        <a href="{{ route('coops.index') }}" class="hover:underline">Coops</a> &gt;
        <span class="font-semibold">{{ $coop->user->name }}</span>
    </nav>

    <!-- Coop Header -->
    <div class="flex items-center mb-8">
        <img src="{{ $coop->user->image ? asset('images/' . $coop->user->image) : asset('images/default-coop.jpg') }}"
             alt="{{ $coop->user->name }}"
             class="w-16 h-16 rounded-full mr-4 object-cover border-2 border-indigo-500">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">{{ $coop->user->name }}'s Products</h1>
            <p class="text-gray-600">{{ $coop->description }}</p>
            @if($coop->contact)
                <p class="text-gray-600 mt-1">Contact: {{ $coop->contact }}</p>
            @endif
        </div>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse ($coop->products as $product)

            <div class="bg-white rounded-xl shadow-md overflow-hidden flex flex-col hover:shadow-xl transition-shadow duration-300 max-w-sm mx-auto">

                <!-- Product Image -->
                <div class="w-full h-40 flex items-center justify-center bg-gray-100 overflow-hidden">
                    <img loading="lazy" src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="max-h-full max-w-full object-contain">
                </div>

                <!-- Product Info -->
                <div class="p-3 flex flex-col flex-1">
                    <h2 class="text-lg font-semibold mb-2 text-gray-800 truncate">{{ $product->name }}</h2>

                    <!-- Comments Section Toggle -->
                    <details class="mb-3">
                        <summary class="cursor-pointer font-semibold text-indigo-600 text-sm">View Comments</summary>
                        <div class="mt-2 space-y-2 max-h-36 overflow-y-auto text-sm">
                            @forelse ($product->comments as $comment)
                                <div class="flex items-start bg-gray-100 p-2 rounded">
                                    <img src="{{ $comment->user && $comment->user->image ? asset('images/' . $comment->user->image) : asset('images/default-user.jpg') }}" 
                                         alt="{{ $comment->user ? $comment->user->name : 'Deleted User' }}" 
                                         class="w-6 h-6 rounded-full mr-2 object-cover border">
                                    <div>
                                        <p class="text-gray-800 text-sm font-semibold">
                                            {{ $comment->user ? $comment->user->name : 'Deleted User' }}
                                        </p>
                                        <p class="text-gray-700 text-sm">{{ $comment->comment }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 text-sm">No comments yet.</p>
                            @endforelse
                        </div>
                    </details>

                    <!-- Add Comment Form -->
                    <form action="{{ route('comments.store', $product->id) }}" method="POST" class="mt-auto">
                        @csrf
                        <textarea name="comment" rows="2" class="w-full p-2 border rounded-lg text-gray-700 mb-2 text-sm" placeholder="Add a comment..." required></textarea>
                        <button type="submit" class="w-full bg-blue-500 text-white font-bold py-1.5 px-4 rounded-lg hover:bg-blue-600 transition-colors text-sm">
                            Post Comment
                        </button>
                    </form>

                </div>
            </div>

        @empty
            <p class="text-gray-600 text-center col-span-3">No products found.</p>
        @endforelse
    </div>

</div>

</body>
</html>
