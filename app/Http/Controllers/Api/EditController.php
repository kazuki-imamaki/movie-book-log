<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WantMovie;

class EditController extends Controller
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
        $id = $request->id;
        $movie = WantMovie::where('user_id', $user_id)->where('id', $id)->first();
        $movie->poster_path = str_replace("342", "154", $movie->poster_path);
        return $movie;
    }
}
