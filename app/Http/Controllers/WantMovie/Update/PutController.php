<?php

namespace App\Http\Controllers\WantMovie\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\WantMovie\UpdateRequest;
use App\Models\WantMovie;

class PutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdateRequest $request)
    {
        $movie = WantMovie::where('id', $request->id())->firstOrFail();
        $movie->title = $request->title();
        $movie->save();
        return redirect()->route('want.movie.update.index', ['movieId' => $movie->id])->with('feedback.success', "編集しました。");
    }
}
