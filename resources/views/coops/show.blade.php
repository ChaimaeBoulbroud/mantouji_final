<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits de {{ $coop->user->name }}</title>
    @vite('resources/css/app.css')
    <style>
        .star {
            font-size: 1.2rem;
            cursor: pointer;
            color: #ccc;
            transition: color 0.2s;
        }
        .star.selected {
            color: #facc15; /* yellow-400 */
        }
    </style>
</head>
<body class="bg-gray-100">

<div class="container mx-auto px-4 py-6">

    <div class="relative flex justify-center items-center mb-8">
        
        <a href="{{ route('coops.index') }}" 
           class="absolute left-0 text-gray-600 hover:text-gray-800 transition-colors flex items-center text-sm font-semibold hover:underline">
           <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
             <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
           </svg>
           Retour aux Coopératives
        </a>

        <img src="{{ asset('images/mantouj-removebg-preview.png') }}" 
              alt="Logo Mantouj" 
              class="h-16 object-contain">
    </div>
    
    <div class="flex items-center mb-8"> 
        <img src="{{ $coop->user->image ? asset('images/' . $coop->user->image) : asset('images/default-coop.jpg') }}"
              alt="{{ $coop->user->name }}"
              class="w-20 h-20 rounded-full mr-6 object-cover border-4 border-orange-600 flex-shrink-0">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-800">Produits de {{ $coop->user->name }}</h1>
            <p class="text-gray-600 mt-1 italic">{{ $coop->description }}</p>
            @if($coop->contact)
                <p class="text-gray-600 text-sm mt-2 font-medium">
                    <span class="font-semibold text-orange-600">Contact:</span> {{ $coop->contact }}
                </p>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse ($coop->products as $product)
            <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 flex flex-col overflow-hidden">

                <div class="w-full h-48 flex items-center justify-center bg-gray-50 overflow-hidden p-2">
                    <img loading="lazy" src="{{ asset('storage/products/' . basename($product->image)) }}"
                          alt="{{ $product->name }}"
                          class="max-h-full max-w-full object-contain transform hover:scale-105 transition-transform duration-500">
                </div>

                <div class="p-4 flex flex-col flex-grow">
                    <h2 class="text-xl font-bold mb-2 text-gray-800 truncate">{{ $product->name }}</h2>

                    @php $avgRating = round($product->averageRating(), 1); @endphp
                    <div class="flex items-center mb-3">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="{{ $i <= round($avgRating) ? 'text-yellow-500' : 'text-gray-300' }} text-lg">&#9733;</span>
                        @endfor
                        <span class="ml-2 text-gray-600 font-semibold text-sm">{{ $avgRating }}/5 </span>
                        <span class="text-gray-500 text-xs">({{ $product->reviewsCount() }} avis)</span>
                    </div>

                    <details class="mb-4">
                        <summary class="cursor-pointer font-semibold text-orange-600 hover:text-orange-700 text-sm">Voir les Commentaires & Avis</summary>
                        <div class="mt-3 space-y-3 max-h-48 overflow-y-auto pr-2 text-sm border-t pt-2">
                            @forelse ($product->comments as $comment)
                                <div class="flex items-start bg-gray-50 p-3 rounded-lg border">
                                    <img src="{{ $comment->user && $comment->user->image ? asset('images/' . $comment->user->image) : asset('images/default-user.jpg') }}"
                                          alt="{{ $comment->user ? $comment->user->name : 'Utilisateur Supprimé' }}"
                                          class="w-7 h-7 rounded-full mr-3 object-cover flex-shrink-0">
                                    <div class="flex-grow">
                                        <div class="flex items-center justify-between">
                                            <p class="text-gray-800 font-bold">{{ $comment->user ? $comment->user->name : 'Utilisateur Supprimé' }}</p>
                                            @if($comment->rating > 0)
                                                <div class="flex text-yellow-500 text-sm">
                                                    @for($i=1; $i<=5; $i++)
                                                        <span class="{{ $i <= $comment->rating ? 'text-yellow-500' : 'text-gray-300' }}">&#9733;</span>
                                                    @endfor
                                                </div>
                                            @endif
                                        </div>
                                        @if($comment->comment)
                                            <p class="text-gray-700 mt-1">{{ $comment->comment }}</p>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 text-sm text-center">Aucun commentaire/avis pour le moment.</p>
                            @endforelse
                        </div>
                    </details>
                    
                    <form action="{{ route('comments.store', $product->id) }}" method="POST" class="mt-auto">
                        @csrf
                        <div class="flex mb-2 stars-container" data-product-id="{{ $product->id }}">
                            <span class="text-sm font-medium text-gray-700 mr-2">Note:</span>
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="star" data-value="{{ $i }}">&#9733;</span>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" value="0" id="rating-{{ $product->id }}">
                        <textarea name="comment" rows="2" class="w-full p-2 border border-gray-300 rounded-lg text-gray-700 mb-2 text-sm focus:ring-orange-500 focus:border-orange-500" placeholder="Ajouter un commentaire ou un avis..."></textarea>
                        
                        <button type="submit"
                            class="w-full bg-gray-200 text-gray-700 font-bold py-2 px-4 rounded-lg hover:bg-gray-300 transition-colors text-sm shadow-sm">
                            Publier l'Avis
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-600 text-center col-span-full py-10 text-xl font-medium">Aucun produit trouvé pour {{ $coop->user->name }}.</p>
        @endforelse
    </div>
</div>

<script>
// Le script JavaScript pour la gestion des étoiles n'a pas besoin d'être traduit
document.querySelectorAll('.stars-container').forEach(container => {
    const stars = container.querySelectorAll('.star');
    const productId = container.dataset.productId;
    const hiddenInput = document.getElementById('rating-' + productId);
    let currentRating = 0; 

    stars.forEach((star, index) => {
        star.addEventListener('click', () => {
            currentRating = index + 1;
            hiddenInput.value = currentRating;
            updateStars();
        });

        star.addEventListener('mouseover', () => {
             stars.forEach(s => s.classList.remove('hovered')); 
             for (let i = 0; i <= index; i++) {
                 stars[i].classList.add('hovered');
             }
        });

        container.addEventListener('mouseleave', () => {
             stars.forEach(s => s.classList.remove('hovered'));
             updateStars();
        });
    });

    function updateStars() {
        stars.forEach((s, i) => {
            s.classList.remove('selected');
            s.classList.remove('hovered');
            if (i < currentRating) {
                s.classList.add('selected');
            }
        });
    }
});
</script>

</body>
</html>