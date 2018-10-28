<?php

namespace App\Http\Controllers;

use App\Cat;
use App\Http\Requests\CatStoreRequest;
use App\Http\Requests\CatUpdateRequest;

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

        return view('pages.cat.index')
            ->with('cats', $cats);
    }

    /**
     * Show the form for creating a new cat.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('pages.cat.create');
    }

    /**
     * Store a newly created cat in storage.
     *
     * @param CatStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CatStoreRequest $request) {
        $cat = $this->cat->create($request->all());

        return redirect()->route('cats.index');
    }

    /**
     * Display the specified cat.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $cat = $this->cat->findOrFail($id);

        return view('pages.cat.show')->with('cat', $cat);
    }

    /**
     * Show the form for editing the specified cat.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $cat = $this->cat->findOrFail($id);

        return view('pages.cat.edit')
            ->with('cat', $cat);
    }

    /**
     * Update the specified cat in storage.
     *
     * @param  int $id
     * @param CatUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, CatUpdateRequest $request) {
        $this->cat->findOrFail($id)->update($request->all());

        return redirect()->route('cats.show', array($id));
    }
}
