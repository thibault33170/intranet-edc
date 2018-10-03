<?php

namespace App\Http\Controllers;

use App\Http\Requests\BenevoleUpdateRequest;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class BenevoleController extends Controller
{
    /**
     * @var User
     */
    private $user;

    /**
     * BenevoleController constructor.
     * @param User $user
     */
    public function __construct(User $user) {
        $this->user = $user;
    }

    /**
     * Display a listing of the benevole.
     *
     * @return Response
     */
    public function index() {
        $benevoles = $this->user->all();

        return view('pages.benevole.index')->with('benevoles', $benevoles);
    }

    /**
     * Display the specified benevole.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id) {
        $benevole = $this->user->find($id);

        return view('pages.benevole.show')->with('benevole', $benevole);
    }

    /**
     * Show the form for editing the specified benevole.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id) {
        $benevole = $this->user->find($id);

        return view('pages.benevole.edit')->with('benevole', $benevole);
    }

    /**
     * Update the specified benevole in storage.
     *
     * @param  int $id
     * @param BenevoleUpdateRequest $request
     * @return RedirectResponse
     */
    public function update($id, BenevoleUpdateRequest $request) {
        $this->user->find($id)->update($request->all());

        return redirect()->route('benevoles.show', array($id))->with('status', 'Bénévole mis à jour');
    }
}
