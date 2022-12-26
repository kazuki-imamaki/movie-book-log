<?php

namespace App\Http\Controllers\WantMovie\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WantMovie;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $movieId = (int) $request->route('movieId');
        $wantMovie = WantMovie::where('id', $movieId)->firstOrFail();
        if (is_null($movieId)) {
            throw new NotFoundHttpException('存在しません');
        }
        return view('movie.want.update')->with('wantMovie', $wantMovie);
    }
}
