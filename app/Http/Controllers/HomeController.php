<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\ViewModels\HomeViewModel;

class HomeController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trending = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/trending/all/day')
            ->json()['results'];


        $genres = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];

        $genresTV = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/genre/tv/list')
        ->json()['genres'];

        foreach($genresTV as $genre) {
            array_push($genres, $genre);
        }


        $viewModel = new HomeViewModel(
            $trending,
            $genres
        );

        return view('home.index', $viewModel);
    }

}
