<?php

namespace App\Http\Controllers;

use App\Capture;
use App\Http\Requests\CaptureStoreRequest;
use App\Http\Requests\CaptureUpdateRequest;
use App\User;
use Illuminate\Http\Request;

class CaptureController extends Controller
{
    /**
     * @var Capture
     */
    private $capture;

    /**
     * @var User
     */
    private $user;

    /**
     * CaptureController constructor.
     * @param Capture $capture
     * @param User $user
     */
    public function __construct(Capture $capture, User $user) {
        $this->capture = $capture;
        $this->user = $user;
    }

    /**
     * Display a listing of the capture.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $captures = $this->capture->all();

        return view('pages.capture.index')->with('captures', $captures);
    }

    /**
     * Show the form for creating a new capture.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('pages.capture.create');
    }

    /**
     * Store a newly created capture in storage.
     *
     * @param CaptureStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CaptureStoreRequest $request) {
        $capture = $this->capture->create($request->all());

        return redirect()->route('captures.edit', array($capture->id));
    }

    /**
     * Display the specified capture.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $capture = $this->capture->find($id);

        return view('pages.capture.show')->with('capture', $capture);
    }

    /**
     * Show the form for editing the specified capture.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $capture = $this->capture->find($id);
        $benevoles = $this->user->all();

        return view('pages.capture.edit')
            ->with('capture', $capture)
            ->with('benevoles', $benevoles);
    }

    /**
     * Update the specified capture in storage.
     *
     * @param  int $id
     * @param CaptureUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, CaptureUpdateRequest $request) {
        $this->capture->find($id)->update($request->all());

        return redirect()->route('captures.show', array($id));
    }

    public function attach(Request $request) {
        $capture = $this->capture->find($request->input('capture_id'));

        $capture->users()->attach($request->input('user_id'));

        return back()->with('status', 'Participation prise en compte');
    }

    public function detach(Request $request) {
        $capture = $this->capture->find($request->input('capture_id'));

        $capture->users()->detach($request->input('user_id'));

        return back()->with('status', 'Participation annulée');
    }
}
