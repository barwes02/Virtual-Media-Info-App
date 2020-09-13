<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Carbon\Carbon;

class HomeViewModel extends ViewModel
{
    public $trending;
    public $genres;
    
    public function __construct($trending, $genres)
    {
        $this->trending = $trending;
        $this->genres = $genres;
    }

    public function trending() 
    {
        return $this->formatTrending($this->trending);
    }

    public function genres() 
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatTrending($shows)
    {
        return collect($shows)->map(function($show) {
            $genresFormatted = collect($show['genre_ids'])->mapWithKeys(function($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            if (isset($show['release_date'])) {
                $releaseDate = Carbon::parse($show['release_date'])->format('M d, Y');
            } elseif (isset($show['first_air_date'])) {
                $releaseDate = Carbon::parse($show['first_air_date'])->format('M d, Y');
            } else {
                $releaseDate = '';
            }

            if (isset($show['title'])) {
                $title = $show['title'];
            } elseif (isset($show['name'])) {
                $title = $show['name'];
            } else {
                $title = 'Untitled';
            }

            return collect($show)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500'.$show['poster_path'],
                'vote_average' => $show['vote_average'] * 10 . '%',
                'release_date' => $releaseDate,
                'genres' => $genresFormatted,
                'title' => $title,
            ])->only([
                'poster_path', 'id', 'genre_ids', 'title', 'vote_average', 'overview', 'release_date', 'genres', 'media_type'
            ]);
        });
    }
}
