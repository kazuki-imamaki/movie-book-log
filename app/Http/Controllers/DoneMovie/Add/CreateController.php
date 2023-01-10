<?php

namespace App\Http\Controllers\DoneMovie\Add;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DoneMovie\CreateRequest;
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
        $doneMovie = new WantMovie();
        $doneMovie->title = $request->title();
        $doneMovie->memo = $request->memo();
        $doneMovie->image = $request->image();
        // $doneMovie->star = $request->star();
        $doneMovie->user_id = $request->userId();
        $doneMovie->is_done = $request->is_done();

        $doneMovie->save();
        return redirect()->route('done.movie.index');
    }
}
