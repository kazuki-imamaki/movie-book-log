<?php

namespace App\Http\Controllers\WantMovie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WantMovie;
use Inertia\Inertia;

class IndexController extends Controller
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

        $wantMovies = WantMovie::where('user_id', $user_id)->where('is_done', 0)->orderBy('updated_at', 'desc')->get();

        if (count($request->query) == 0) {
            return Inertia::render('Movies/Want/IndexPage', [
                'movies' => $wantMovies,
                'editFlag' => false
            ]);
        }

        // create時の検索結果
        if ($request[1]["editFlag"] == "0" && count($request->query) != 0) {
            return Inertia::render('Movies/Want/IndexPage', [
                'movies' => $wantMovies,
                'additionalMovie' => $request[0],
                'showFlag' => true,
                'editFlag' => false,
                'keepValue' => $request[1]
            ]);
        }

        // update時の検索結果
        if ($request[1]["editFlag"] == "1") {
            return Inertia::render('Movies/Want/IndexPage', [
                'movies' => $wantMovies,
                'toEditMovie' => $request[0],
                'showFlag' => true,
                'editFlag' => true,
                'keepValue' => $request[1]
            ]);
        }
    }
}
