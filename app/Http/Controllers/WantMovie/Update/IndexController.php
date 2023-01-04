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
        // dd($request->query);
        $movieId = (int) $request->route('movieId');
        $wantMovie = WantMovie::where('id', $movieId)->firstOrFail();
        if (is_null($movieId)) {
            throw new NotFoundHttpException('存在しません');
        }

        if (is_null($request->title)) {
            $editted_movie = array(
                'id' => $wantMovie->id,
                'title' => $wantMovie->title,
                'memo' => $wantMovie->memo,
                'image' => str_replace("342", "154", $wantMovie->image),
            );
        } else {
            $editted_movie = array(
                'id' => $wantMovie->id,
                'title' => $request->title,
                'memo' => $wantMovie->memo,
                'image' =>  str_replace("342", "154", $request->poster_path),
            );
        }
        // dd($editted_movie);
        return view('movie.want.update')->with('wantMovie', $editted_movie);
        // return view('movie.want.update')->with('wantMovie', $wantMovie);
    }
}
