@extends('layouts.main')

@section('content')


<div class="movie-info border-b border-gray-800">
    <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
        <div class="flex-none">
            <img src="{{ $actor['profile_path'] }}" alt="Movie" class="w-96 md:h-auto h-screen">
            <ul class="flex items-center mt-4">
                @if ($social['facebook'])
                    <li >
                        <a href="{{ $social['facebook'] }}" title="Facebook"><i class="fa fa-facebook-square" style="font-size:24px"></i></a>
                    </li>
                @endif
                @if ($social['instagram'])
                    <li class="ml-6">
                        <a href="{{ $social['instagram'] }}" title="Instagram"><i class="fa fa-instagram" style="font-size:24px"></i></a>
                    </li>
                @endif
                @if ($social['twitter'])
                    <li class="ml-6">
                        <a href="{{ $social['twitter'] }}" title="Twitter"><i class="fa fa-twitter" style="font-size:24px"></i></a>
                    </li>
                @endif
                @if ($actor['homepage'])
                    <li class="ml-6">
                        <a href="{{ $actor['homepage'] }}" title="Website"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-globe" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4H2.255a7.025 7.025 0 0 1 3.072-2.472 6.7 6.7 0 0 0-.597.933c-.247.464-.462.98-.64 1.539zm-.582 3.5h-2.49c.062-.89.291-1.733.656-2.5H3.82a13.652 13.652 0 0 0-.312 2.5zM4.847 5H7.5v2.5H4.51A12.5 12.5 0 0 1 4.846 5zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5H7.5V11H4.847a12.5 12.5 0 0 1-.338-2.5zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12H7.5v2.923c-.67-.204-1.335-.82-1.887-1.855A7.97 7.97 0 0 1 5.145 12zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11H1.674a6.958 6.958 0 0 1-.656-2.5h2.49c.03.877.138 1.718.312 2.5zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12h2.355a7.967 7.967 0 0 1-.468 1.068c-.552 1.035-1.218 1.65-1.887 1.855V12zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5h-2.49A13.65 13.65 0 0 0 12.18 5h2.146c.365.767.594 1.61.656 2.5zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4H8.5V1.077c.67.204 1.335.82 1.887 1.855.173.324.33.682.468 1.068z"/>
                        </svg></a>
                    </li>
                @endif
            </ul>
        </div>
        <div class="md:ml-24">
            <h2 class="text-4xl font-semibold">{{ $actor['name'] }}</h2>
            <div class="flex flex-wrap items-center text-gray-400 text-sm ">
                 <span class="ml-1">{{ $actor['birthday'] }} ({{ $actor['age'] }} years old) in {{ $actor['place_of_birth'] }}</span>
            </div>

            <p class="text-gray-300 mt-8">{{ $actor['biography'] }}</p>

            <h4 class="font-semibold mt-12">Known For</h4>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8">
                @foreach ($knownForTitles as $movie)
                    <div class="mt-4">
                        <a href="{{ $movie['linkToPage'] }}">
                            <img src="{{ $movie['poster_path'] }}" alt="poster" 
                                class="w-full transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                            </img>
                        </a>
                        <a href="{{ $movie['linkToPage'] }}" class="text-sm leading-normal block text-gray-400 hover:tet-white mt-1">{{ $movie['title'] }}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div> <!-- end movie-info -->

<div class="credits border-b border-gray-800">
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold">Credits</h2>
        <ul class="list-disc leading-loose pl-5 mt-8">
        @foreach ($credits as $credit)
            <li>{{ $credit['release_year'] }} &middot; <strong>{{ $credit['title'] }}</strong> as {{ $credit['character'] }}</li>
        @endforeach
        </ul>
    </div>
</div> <!-- end credits -->


@endsection