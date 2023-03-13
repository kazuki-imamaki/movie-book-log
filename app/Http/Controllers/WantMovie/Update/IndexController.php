<?php

namespace App\Http\Controllers\WantMovie\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WantMovie;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Inertia\Inertia;

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


        if (is_null($request->title)) {
            $toEditMovie = array(
                'id' => $wantMovie->id,
                'title' => $wantMovie->title,
                'memo' => $wantMovie->memo,
                'image' => str_replace("342", "154", $wantMovie->image),
            );
        } else {
            $toEditMovie = array(
                'id' => $wantMovie->id,
                'title' => $request->title,
                'memo' => $wantMovie->memo,
                'imge' =>  str_replace("342", "154", $request->poster_path),
            );
        }
        $user_id = $request->user()->id;
        $wantMovies = WantMovie::where('user_id', $user_id)->where('is_done', 0)->orderBy('updated_at', 'desc')->get();

        return Inertia::render('Movies/Want/IndexPage', [
            'movies' => $wantMovies,
            'toEditMovie' => $toEditMovie,
            'showFlag' => true,
            'editFlag' => true
        ]);
    }
}
