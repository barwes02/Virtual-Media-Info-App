@extends('layouts.main')

@section('content')

<div class="container mx-auto px-4 py-16">
    <div class="popular-tv">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Trending</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
             @foreach($trending as $show)
                <x-movie-card :movie="$show" />
            @endforeach 
        </div>
    </div> <!-- end Trending -->
</div>

@endsection