@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-16">
        <div class="popular-movies">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Actors</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($popularActors as $actor)
                    <div class="actor mt-8">
                        <a href="{{ route('actors.show', $actor['id']) }}"> 
                            <img src="{{ $actor['profile_path'] }}" alt="profile image" 
                                class="transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('actors.show', $actor['id']) }}" class="text-lg hover:text-gray-300">{{ $actor['name'] }}</a>
                            <div class="text-sm truncate text-gray-400">{{ $actor['known_for'] }}</div>
                        </div>
                    </div>
                    
                @endforeach
            </div>
        </div>
        <div class="page-load-status">
            <div class="flex justify-center">
                <p class="infinite-scroll-request spinner my-8 text-4xl">&nbsp;</p>
            </div>
            <div class="flex justify-center">
                <p class="infinite-scroll-last my-12 text-4xl">End of content</p>
            </div>
            <p class="infinite-scroll-error my-8 text-4xl">No more pages to load</p>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>

    <script>
        var elem = document.querySelector('.grid');
        var infScroll = new InfiniteScroll( elem, {
            // options
            path: "/actors/page/@{{#}}",
            append: '.actor',
            status: '.page-load-status'
            //history: false,
        });
    </script>
@endsection