<?php

namespace App\Http\Controllers\DoneMovie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DoneMovie;

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

        $doneMovies = DoneMovie::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();

        return view('movie.done.index')->with('wantMovies', $doneMovies);
    }
}
