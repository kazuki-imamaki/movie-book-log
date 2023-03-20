<?php

namespace App\Http\Controllers\WantMovie\Update;

use App\Http\Controllers\Controller;
use App\Http\Requests\WantMovie\CreateUpdateRequest;
use App\Models\WantMovie;

class PutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CreateUpdateRequest $request)
    {
        // dd($request);
        $movie = WantMovie::where('id', $request->id)->firstOrFail();
        $movie->title = $request->title;
        $movie->memo = $request->memo;
        $movie->poster_path = $request->poster_path;
        $movie->poster_path = str_replace("154", "342", $movie->poster_path);
        $movie->is_done = $request->is_done;
        $movie->date = $request->date;
        $movie->star = $request->star;
        // dd($movie);
        $movie->save();
        return redirect()->route('want.movie.index')->with('feedback.success', "編集しました。");
    }
}
