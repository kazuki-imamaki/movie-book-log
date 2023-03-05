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

        // $wantMovies = WantMovie::where('user_id', $user_id)->where('is_done', 0)->orderBy('updated_at', 'desc')->get();


        // return view('movie.want.index')->with('wantMovies', $wantMovies);
        return Inertia::render('Movies/Want/IndexPage', [
            'movies' => WantMovie::where('user_id', $user_id)->where('is_done', 0)->orderBy('updated_at', 'desc')->get()
        ]);
    }
}
