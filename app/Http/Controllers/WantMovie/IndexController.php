<?php

namespace App\Http\Controllers\WantMovie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WantMovie;

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

        $wantMovies = WantMovie::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();


        return view('movie.want.index')->with('wantMovies', $wantMovies);
    }
}
