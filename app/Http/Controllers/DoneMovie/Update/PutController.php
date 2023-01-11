<?php

namespace App\Http\Controllers\DoneMovie\Update;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoneMovie\CreateUpdateRequest;
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
        $movie = WantMovie::where('id', $request->id())->firstOrFail();
        $movie->title = $request->title();
        $movie->memo = $request->memo();
        $movie->image = $request->image();
        $movie->image = str_replace("154", "342", $movie->image);
        $movie->is_done = $request->is_done();
        $movie->save();
        return redirect()->route('done.movie.update.index', ['movieId' => $movie->id])->with('feedback.success', "編集しました。");
    }
}
