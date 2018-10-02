<?php

namespace App\Http\Controllers;

use App\Cat;

class CatController extends Controller
{
    /**
     * @var Cat
     */
    private $cat;

    /**
     * CatController constructor.
     * @param Cat $cat
     */
    public function __construct(Cat $cat) {
        $this->cat = $cat;
    }

    /**
     * Display a listing of the cat.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $cats = $this->cat->all();

        return view('pages.cats.index')
            ->with('cats', $cats);
    }
}
