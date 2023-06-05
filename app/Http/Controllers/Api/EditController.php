<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WantMovie;
use App\Models\Image;

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

        $image = Image::where('id', $movie->images_id)->first();
        $movie['poster'] = $image->name;


        return $movie;
    }
}
