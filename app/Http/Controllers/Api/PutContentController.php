<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WantMovie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class PutContentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        Log::debug("logMsg", [$request->id]);
        $movie = WantMovie::where('id', $request->id)->firstOrFail();
        $movie->title = $request->title;
        $movie->memo = $request->memo;
        $movie->poster_path = $request->poster_path;
        $movie->poster_path = str_replace("154", "342", $movie->poster_path);
        $movie->is_done = $request->is_done;
        $movie->date = $request->date;
        $movie->star = $request->star;
        $movie->save();
    }
}
