<?php

namespace App\Http\Controllers\WantMovie\Add;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // dd($request->title, $request->poster_path);
        // dd($request);

        return view('movie.want.index')->with("request", $request)->with("showModal", true);
    }
}
