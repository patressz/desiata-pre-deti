<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Setting;
use App\Models\Children;
use Illuminate\Http\Request;
use App\Http\Requests\ChildrenRequest;
use App\Models\School;
use Illuminate\Contracts\Session\Session;

class ChildrenController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Children::class, 'children');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $childrens = Children::where('user_id', auth()->id())->get();
        $schools = School::all();

        return view('my-childrens')->with([
            'childrens' => $childrens,
            'schools' => $schools,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schools = School::all();

        return view('add-children', compact('schools') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChildrenRequest $request)
    {
        Children::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'class' => $request->class,
            'school' => $request->school,
        ]);

        if ( $request->session()->get('url') ) {
            $url = $request->session()->get('url');
            $request->session()->forget('url');

            return redirect($url);
        }

        return redirect()->route('childrens.index')->withStatus('Dieťa bolo úspešne pridané.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Children $children
     * @return \Illuminate\Http\Response
     */
    public function show(Children $children)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Children $children
     * @return \Illuminate\Http\Response
     */
    public function edit(Children $children)
    {
        $schools = School::all();

        return view('edit-children', compact('children', 'schools') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Children $child
     * @return \Illuminate\Http\Response
     */
    public function update(ChildrenRequest $request, Children $children)
    {
        $children->update([
            'name' => $request->name,
            'class' => $request->class,
            'school' => $request->school,
        ]);

        return redirect()->route('childrens.index')->withStatus('Informácie o dieťati boli úspešne zmenené.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Children $children
     * @return \Illuminate\Http\Response
     */
    public function destroy(Children $children)
    {
        if ( empty(Order::where('child_id', $children->id)->where('status', 0)->count()) ) {

            $children->delete();

            return redirect()->route('childrens.index')->withStatus("Dieťa bolo úspešne odstránené.");
        } else {
            return redirect()->route('childrens.index')->withErrors('Dieťa nie je možné odstrániť!');
        }
    }
}
