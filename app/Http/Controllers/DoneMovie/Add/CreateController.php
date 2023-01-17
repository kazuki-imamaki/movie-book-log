<?php

namespace App\Http\Controllers\DoneMovie\Add;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoneMovie\CreateUpdateRequest;
use App\Models\WantMovie;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CreateUpdateRequest $request)
    {
        $doneMovie = new WantMovie();
        $doneMovie->title = $request->title();
        $doneMovie->memo = $request->memo();
        $doneMovie->image = str_replace("154", "342", $request->image());
        $doneMovie->user_id = $request->userId();
        $doneMovie->is_done = $request->is_done();
        $doneMovie->date = $request->rDate();
        $doneMovie->star = $request->star();
        // dd($doneMovie);
        $doneMovie->save();
        return redirect()->route('done.movie.index');
    }
}
