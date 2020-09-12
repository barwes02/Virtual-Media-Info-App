<div class="relative mt-3 md:mt-0" x-data="{ isOpen: true }" @click.away="isOpen = false">
    <input 
        wire:model="search" 
        type="text" 
        class="bg-gray-800 text-sm rounded-full w-64 pl-8 px-5  py-2 focus:outline-none 
        focus:shadow-outline" 
        placeholder="Search (press '/' to focus)"
        x-ref="search"
        @keydown.window = "
            if(event.keyCode == 191) {
                event.preventDefault();
                $refs.search.focus();
            }
        "
        @focus="isOpen = true"
        @keydown="isOpen = true"
        @keydown.escape.window="isOpen = false"
        @keydown.shift.tab="isOpen = false"    
    >
    <div class="absolute top-0">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search fill-current text-gray-500 mt-3 ml-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
           <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
        </svg>
    </div>
    <div wire:loading class="spinner absolute top-0 right-0 mr-4 mt-4" role="status">
    </div>
    @if (strlen($search) > 2)
        <div 
            class="z-50 absolute bg-gray-800 text-sm rounded w-64 mt-2" 
            x-show.transition.opacity="isOpen"
        >
            @if($searchResults->count() > 0)
            <ul>
                @foreach ($searchResults as $result)
                    <li class="border-b border-gray-700 w-64">
                        @if ($result['media_type'] == 'movie')
                        <a 
                            href="{{ route('movies.show', $result['id']) }}" 
                            class="block hover:bg-gray-700 px-3 py-3 flex items-center"
                        >
                        @elseif ($result['media_type'] == 'tv')
                        <a 
                            href="{{ route('tv.show', $result['id']) }}" 
                            class="block hover:bg-gray-700 px-3 py-3 flex items-center"
                        >
                        @else
                        <a 
                            href="{{ route('actors.show', $result['id']) }}" 
                            class="block hover:bg-gray-700 px-3 py-3 flex items-center"
                        >
                        @endif
                        @if (isset($result['poster_path']))
                            <img src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}" alt="poster" class="w-12">
                        @elseif (isset($result['profile_path']))
                            <img src="https://image.tmdb.org/t/p/w92/{{ $result['profile_path'] }}" alt="poster" class="w-12">
                        @else
                            @if (isset($result['name']))
                                <img src="https://ui-avatars.com/api/?size=235&name={{ $result['name'] }}" alt="poster" class="w-12">
                            @else
                                <img src="https://ui-avatars.com/api/?size=235&name={{ $result['title'] }}" alt="poster" class="w-12">
                            @endif
                        @endif
                        @if (isset($result['name']))
                        <span class="ml-4">{{ $result['name'] }}</span>
                        @else
                        <span class="ml-4">{{ $result['title'] }}</span>
                        @endif
                        </a>
                    </li>
                @endforeach
            </ul>
            @else
                <div class="px-3 py-3">No results for "{{ $search }}"</div>
            @endif
        </div>
    @endif
</div>
