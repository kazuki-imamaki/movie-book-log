<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchImageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $contentTitle = $request->title;
        $base_url = "https://image.tmdb.org/t/p/w154";
        $api_key = config('services.tmdb.api-key');

        $search_movie_url =
            file_get_contents("https://api.themoviedb.org/3/search/movie?api_key=" . $api_key . "&language=ja-JA&query=" . $contentTitle . "&page=1&include_adult=false");
        $contentsArray = json_decode($search_movie_url, true);
        $results = $contentsArray["results"];

        foreach ($results as &$result) {
            $result["poster_path"] = $base_url . $result["poster_path"];
        }
        unset($result);

        return $results;
    }
}
