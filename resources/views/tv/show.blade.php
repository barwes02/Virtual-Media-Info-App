@extends('layouts.main')

@section('content')


<div class="tv-info border-b border-gray-800">
    <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
        <img src="{{ $tvshow['poster_path'] }}" alt="tvshow" class="w-96 md:h-auto h-screen">
        <div class="md:ml-24">
            <h2 class="text-4xl font-semibold">{{ $tvshow['name'] }}</h2>
            <div class="flex flex-wrap items-center text-gray-400 text-sm ">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star-fill text-orange-500 w-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                </svg> <span class="ml-1">{{ $tvshow['vote_average'] }}</span>
                <span class="mx-2">|</span>
                <span>{{ $tvshow['first_air_date'] }}</span>
                <span class="mx-2">|</span>
                <span>
                    {{ $tvshow['genres'] }}
                </span>
            </div>

            <p class="text-gray-300 mt-8">{{ $tvshow['overview'] }}
            </p>

            <div class="mt-12">
                <div class="flex mt-4">
                       @foreach ($tvshow['created_by'] as $crew) 
                                <div class="mr-8">
                                    <div>{{ $crew['name'] }}</div>
                                    <div class="text-sm text-gray-400">Creator</div>
                                </div>
                       @endforeach
                </div>
            </div>

            <div x-data="{ isOpen: false }">
                @if (count($tvshow['videos']['results']) > 0)
                <div class="mt-12">
                    <button 
                        @click="isOpen = true"
                        class="flex inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold
                        px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150"
                    >
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-play" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10.804 8L5 4.633v6.734L10.804 8zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C4.713 12.69 4 12.345 4 11.692V4.308c0-.653.713-.998 1.233-.696l6.363 3.692z" />
                        </svg>
                        <span class="ml-2">Play Trailer</span>
                    </buttom>
                </div>
                @endif

                <div 
                    style="background-color: rgba(0, 0, 0, .5);"
                    class="fixed z-50 top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                    x-show.transition.opacity="isOpen"
                >
                    <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                        <div class="bg-gray-900 rounded">
                            <div class="flex justify-end pr-4 pt-2">
                                <button 
                                @click="isOpen = false" 
                                class="text-3xl leading-none hover:text-gray-300">&times;</button>
                            </div>
                            <div class="modal-body px-8 py-8">
                                <div class="responsive-container overflow-hidden relative" 
                                    style="padding-top: 56.25%">
                                    <iframe width="560" height="315" class="responsive-iframe absolute top-0 left-0 w-full h-full" 
                                    src="https://www.youtube.com/embed/{{ $tvshow['videos']['results'][0]['key'] }}" style="border:0;" allow="autoplay; encrypted-medi" 
                                    allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end tvshow-info -->

<div class="tvshow-cast border-b border-gray-800">
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold">Cast</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
        @foreach ($tvshow['cast'] as $cast) 
                <div class="mt-8">
                    <a href="{{ route('actors.show', $cast['id']) }}">
                        <img src="{{ 'https://image.tmdb.org/t/p/w300/'.$cast['profile_path'] }}" alt="{{ $tvshow['name'] }}" class="w-full transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                    </a>
                    <div class="mt-2">
                        <a href="{{ route('actors.show', $cast['id']) }}" class="text-lg mt-2 hover:text-gray-300">{{ $cast['character'] }}</a>
                        <div class="text-sm">
                            {{ $cast['name'] }}
                        </div>
                    </div>
                </div>
        @endforeach
        </div>
    </div>
</div>

<div class="tv-images" x-data="{ isOpen: false, image: '' }">
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold">Images</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach ($tvshow['images'] as $image)
                    <div class="mt-8">
                        <a 
                        @click.prevent="
                            isOpen = true
                            image = '{{ 'https://image.tmdb.org/t/p/original/'.$image['file_path'] }}'
                        "
                        href="#"
                        >
                            <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$image['file_path'] }}" alt="{{ $tvshow['name'] }}" 
                            class="w-full transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                            </img>
                        </a>
                    </div>
            @endforeach
        </div>

        <div 
            style="background-color: rgba(0, 0, 0, .5);"
            class="fixed z-50 top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
            x-show.transition.opacity="isOpen"
        >
            <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                <div class="bg-gray-900 rounded">
                    <div class="flex justify-end pr-4 pt-2">
                        <button 
                            @click="isOpen = false" 
                            @keydown.escape.window="isOpen = false" 
                            class="text-3xl leading-none hover:text-gray-300">&times;</button>
                        </div>
                        <div class="modal-body px-8 py-8">
                            <img :src="image" alt="poster">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection