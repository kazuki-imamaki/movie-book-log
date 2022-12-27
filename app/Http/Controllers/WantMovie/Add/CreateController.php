<?php

namespace App\Http\Controllers\WantMovie\Add;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\WantMovie\CreateRequest;
use App\Models\WantMovie;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CreateRequest $request)
    {
        $wantMovie = new WantMovie;
        $wantMovie->title = $request->title();
        $wantMovie->memo = $request->memo();
        $wantMovie->user_id = $request->userId();
        $wantMovie->save();
        return redirect()->route('want.movie.index');
    }
}
