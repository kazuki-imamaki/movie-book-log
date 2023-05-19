<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WantMovie;
use App\Models\Image;

class GetWantController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user_id = $request->user()->id;
        $movies = WantMovie::where('user_id', $user_id)->where('is_done', 0)->orderBy('updated_at', 'desc')->get();

        foreach ($movies as &$movie) {
            $movie = array(
                'poster' => Image::where('id', $movie->images_id)->first()
            );
        }
        unset($movie);

        return $movies;
    }
}
