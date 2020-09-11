<div>
    <div class="mt-8">
        <a href="{{ route('movies.show', $movie['id']) }}">
            <img src="{{ $movie['poster_path'] }}" alt="Poster" class="transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
        </a>
        <div class="mt-2">
            <a href="{{ route('movies.show', $movie['id']) }}" class="text-lg mt-2 hover:text-gray-300">{{ $movie['title'] }}</a>
            <div class="flex items-center text-gray-400 text-sm mt-1">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star-fill text-orange-500 w-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                </svg> <span class="ml-1">{{ $movie['vote_average'] }}</span>
                <span class="mx-2">|</span>
                <span>{{ $movie['release_date'] }}</span>
            </div>
            <div class="text-gray-400 text-sm">{{ $movie['genres'] }}</div>
        </div>
    </div>
</div>