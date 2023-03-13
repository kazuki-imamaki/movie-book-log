<?php

namespace App\Http\Controllers\WantMovie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WantMovie;

class DeleteController extends Controller
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
        $wantMovie = WantMovie::where('id', $movieId)->firstOrFail();
        $wantMovie->delete();
        return redirect()->route('want.movie.index')->with('feedback.success', "映画を削除しました");
    }
}
