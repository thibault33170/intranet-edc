<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Validator;

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
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the benevole.
     *
     * @return Response
     */
    public function index()
    {
        $benevoles = $this->user->all();
        return view('pages.benevole.index')->with('benevoles', $benevoles);
    }

    /**
     * Display the specified benevole.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $benevole = $this->user->find($id);

        return view('pages.benevole.show')->with('benevole', $benevole);
    }

    /**
     * Show the form for editing the specified benevole.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $benevole = $this->user->find($id);
        return view('pages.benevole.edit')->with('benevole', $benevole);
    }

    /**
     * Update the specified benevole in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'dob' => 'date|date_format:Y-m-d|before:now',
            'fa' => 'required|boolean',
            'capture' => 'required|boolean',
            'feeding' => 'required|boolean',
            'member' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $this->user->find($id)->update($request->all());

        return Redirect::route('benevoles.show', array($id))->with('status', 'Bénévole mis à jour');
    }
}
