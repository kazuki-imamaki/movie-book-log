<?php

namespace App\Http\Controllers\DoneMovie\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        dd($request);
        // $movieId = (int) $request->route('movieId');
        // $doneMovie =
    }
}
