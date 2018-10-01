<?php

namespace App\Http\Controllers;

use App\Capture;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;

class CaptureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $captures = Capture::all();

        return view('pages.capture.index')->with('captures', $captures);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.capture.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'city' => 'required',
            'address' => 'required',
            'date' => 'required|date|date_format:Y-m-d|after:now',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $capture = Capture::create($request->all());

        return Redirect::route('captures.edit', array($capture->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $capture = Capture::find($id);

        return view('pages.capture.show')->with('capture', $capture);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $capture = Capture::find($id);
        $benevoles = User::all();

        return view('pages.capture.edit')
            ->with('capture', $capture)
            ->with('benevoles', $benevoles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'city' => 'required',
            'address' => 'required',
            'date' => 'required|date|date_format:Y-m-d|after:now',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        Capture::find($id)->update($request->all());

        return Redirect::route('captures.show', array($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function attach(Request $request)
    {
        $capture = Capture::find($request->input('capture_id'));

        $capture->users()->attach($request->input('user_id'));

        return back()->with('status', 'Participation prise en compte');
    }

    public function detach(Request $request)
    {
        $capture = Capture::find($request->input('capture_id'));

        $capture->users()->detach($request->input('user_id'));

        return back()->with('status', 'Participation annulée');
    }
}
