<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Carbon\Carbon;

class TvViewModel extends ViewModel
{
    public $popularTV;
    public $topRatedTv;
    public $genres;

    public function __construct($popularTV, $topRatedTv, $genres)
    {
        $this->popularTV = $popularTV;
        $this->topRatedTv = $topRatedTv;
        $this->genres = $genres;
    }

    public function popularTV() 
    {
        return $this->formatTv($this->popularTV);
    }

    public function topRatedTv() 
    {
        return $this->formatTv($this->topRatedTv);
    }

    public function genres() 
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatTv($tv)
    {
        //@foreach($movie['genre_ids'] as $genre) {{ $genres->get($genre) }} @if (!$loop->last), @endif @endforeach


        return collect($tv)->map(function($tvshow) {
            $genresFormatted = collect($tvshow['genre_ids'])->mapWithKeys(function($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');
            return collect($tvshow)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500'.$tvshow['poster_path'],
                'vote_average' => $tvshow['vote_average'] * 10 . '%',
                'first_air_date' => Carbon::parse($tvshow['first_air_date'])->format('M d, Y'),
                'genres' => $genresFormatted,
            ])->only([
                'poster_path', 'id', 'genre_ids', 'name', 'vote_average', 'overview', 'first_air_date', 'genres',
            ]);
        });
    }
}
