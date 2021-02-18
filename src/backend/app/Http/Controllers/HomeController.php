<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Illuminate\Http\Response
     */
    public function __invoke()
    {
        return response()->json($this->response);
    }
}
