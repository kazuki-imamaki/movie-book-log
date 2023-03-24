<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WantMovie;


class PostContentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $movie = new WantMovie;
        $movie->title = $request->title;
        $movie->memo = $request->memo;
        $movie->poster_path = str_replace("154", "342", $request->poster_path);
        $movie->user_id = $request->userId;
        $movie->is_done = $request->is_done;
        if ($movie->is_done == true) {
            $movie->date = $request->date;
            $movie->star = $request->star;
        }
        // dd($movie);
        $movie->save();
    }
}
