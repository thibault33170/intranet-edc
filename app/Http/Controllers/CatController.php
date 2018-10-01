<?php

namespace App\Http\Controllers;

use App\Cat;

class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = Cat::all();

        return view('pages.cats.index')
            ->with('cats', $cats);
    }
}
