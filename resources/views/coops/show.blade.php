<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $coop->user->name }}'s Products</title>
@vite('resources/css/app.css')
<style>
    .star {
        font-size: 1.2rem;
        cursor: pointer;
        color: #ccc;
        transition: color 0.2s;
    }
    .star.selected,
    .star.hovered {
        color: #facc15;
    }
</style>
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
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 max-w-sm mx-auto flex flex-col">

                <!-- Product Image -->
                <div class="w-full h-40 flex items-center justify-center bg-white overflow-hidden">
                    <img loading="lazy" src="{{ asset('storage/products/' . basename($product->image)) }}"
                         alt="{{ $product->name }}"
                         class="max-h-full max-w-full object-contain">
                </div>

                <!-- Product Info -->
                <div class="p-3 flex flex-col">
                    <h2 class="text-lg font-semibold mb-2 text-gray-800 truncate">{{ $product->name }}</h2>

                    <!-- Average Rating -->
                    @php $avgRating = round($product->averageRating(), 1); @endphp
                    <div class="flex items-center mb-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="{{ $i <= round($avgRating) ? 'text-yellow-400' : 'text-gray-300' }}">&#9733;</span>
                        @endfor
                        <span class="ml-2 text-gray-600 text-sm">{{ $avgRating }}/5 ({{ $product->reviewsCount() }} reviews)</span>
                    </div>

                    <!-- Comments Section -->
                    <details class="mb-3">
                        <summary class="cursor-pointer font-semibold text-indigo-600 text-sm">View Comments & Reviews</summary>
                        <div class="mt-2 space-y-2 max-h-36 overflow-y-auto text-sm">
                            @forelse ($product->comments as $comment)
                                <div class="flex items-start bg-gray-100 p-2 rounded">
                                    <img src="{{ $comment->user && $comment->user->image ? asset('images/' . $comment->user->image) : asset('images/default-user.jpg') }}"
                                         alt="{{ $comment->user ? $comment->user->name : 'Deleted User' }}"
                                         class="w-6 h-6 rounded-full mr-2 object-cover border">
                                    <div>
                                        <p class="text-gray-800 text-sm font-semibold">{{ $comment->user ? $comment->user->name : 'Deleted User' }}</p>
                                        @if($comment->rating > 0)
                                            <div class="flex text-yellow-400 text-sm">
                                                @for($i=1; $i<=5; $i++)
                                                    <span class="{{ $i <= $comment->rating ? 'text-yellow-400' : 'text-gray-300' }}">&#9733;</span>
                                                @endfor
                                            </div>
                                        @endif
                                        @if($comment->comment)
                                            <p class="text-gray-700 text-sm">{{ $comment->comment }}</p>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 text-sm">No comments/reviews yet.</p>
                            @endforelse
                        </div>
                    </details>

                    <!-- Add Comment Form -->
                    <form action="{{ route('comments.store', $product->id) }}" method="POST">
                        @csrf
                        <div class="flex mb-2 stars-container" data-product-id="{{ $product->id }}">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="star" data-value="{{ $i }}">&#9733;</span>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" value="0" id="rating-{{ $product->id }}">
                        <textarea name="comment" rows="2" class="w-full p-2 border rounded-lg text-gray-700 mb-2 text-sm" placeholder="Add a comment or review..."></textarea>
                        <button type="submit"   class="w-full bg-green-700 text-white font-bold py-1.5 px-4 rounded-lg hover:bg-green-800 transition-colors text-sm">
                            Post Comment / Review
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-600 text-center col-span-3">No products found.</p>
        @endforelse
    </div>
</div>

<script>
document.querySelectorAll('.stars-container').forEach(container => {
    const stars = container.querySelectorAll('.star');
    const productId = container.dataset.productId;
    const hiddenInput = document.getElementById('rating-' + productId);

    stars.forEach((star, index) => {
        star.addEventListener('click', () => {
            hiddenInput.value = index + 1;
            stars.forEach(s => s.classList.remove('selected'));
            for (let i = 0; i <= index; i++) {
                stars[i].classList.add('selected');
            }
        });
    });
});
</script>

</body>
</html>
