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
    /** @var Capture */
    private $capture;

    /** @var User */
    private $user;

    /**
     * CaptureController constructor.
     * @param Capture $capture
     * @param User $user
     */
    public function __construct(Capture $capture, User $user)
    {
        $this->capture = $capture;
        $this->user = $user;
    }

    /**
     * Display a listing of the capture.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $captures = $this->capture->all();

        return view('pages.capture.index')->with('captures', $captures);
    }

    /**
     * Show the form for creating a new capture.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.capture.create');
    }

    /**
     * Store a newly created capture in storage.
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

        $capture = $this->capture->create($request->all());

        return Redirect::route('captures.edit', array($capture->id));
    }

    /**
     * Display the specified capture.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $capture = $this->capture->find($id);

        return view('pages.capture.show')->with('capture', $capture);
    }

    /**
     * Show the form for editing the specified capture.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $capture = $this->capture->find($id);
        $benevoles = $this->user->all();

        return view('pages.capture.edit')
            ->with('capture', $capture)
            ->with('benevoles', $benevoles);
    }

    /**
     * Update the specified capture in storage.
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

        $this->capture->find($id)->update($request->all());

        return Redirect::route('captures.show', array($id));
    }

    public function attach(Request $request)
    {
        $capture = $this->capture->find($request->input('capture_id'));

        $capture->users()->attach($request->input('user_id'));

        return back()->with('status', 'Participation prise en compte');
    }

    public function detach(Request $request)
    {
        $capture = $this->capture->find($request->input('capture_id'));

        $capture->users()->detach($request->input('user_id'));

        return back()->with('status', 'Participation annulée');
    }
}
