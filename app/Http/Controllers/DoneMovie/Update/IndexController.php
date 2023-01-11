<?php

namespace App\Http\Controllers\DoneMovie\Update;

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
        // dd($request);
        $movieId = (int) $request->route('movieId');
        $doneMovie = WantMovie::where('id', $movieId)->firstOrFail();

        if (is_null($request->title)) {
            $editted_movie = array(
                'id' => $doneMovie->id,
                'title' => $doneMovie->title,
                'memo' => $doneMovie->memo,
                'image' => str_replace("342", "154", $doneMovie->image),
                'date' => $doneMovie->date,
            );
        } else {
            $editted_movie = array(
                'id' => $doneMovie->id,
                'title' => $request->title,
                'memo' => $doneMovie->memo,
                'image' =>  str_replace("342", "154", $request->poster_path),
                'date' => $doneMovie->date,
            );
        }

        return view('movie.done.update')->with('doneMovie', $editted_movie);
    }
}
