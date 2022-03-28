<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserPasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findOrFail( auth()->id() );

        return view('my-account', compact('user') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $my_account
     * @return \Illuminate\Http\Response
     */
    public function show(User $my_account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $my_account
     * @return \Illuminate\Http\Response
     */
    public function edit(User $my_account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $my_account
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $my_account)
    {
        $this->authorize('update-user', $my_account);

        $my_account->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('my-account.index')->withStatus('Informácie o konte boli úspešne aktualizované.');
    }

    public function update_password(UpdateUserPasswordRequest $request, User $user_id)
    {
        $this->authorize('update-user', $user_id);

        if ( Hash::check($request->old_password, $user_id->password) ) {

            $user_id->update([
                'password' => Hash::make($request->new_password),
            ]);

            return redirect()->route('my-account.index')->withStatus('Heslo bolo úspešne aktualizované.');
        } else {
            return redirect()->route('my-account.index')->withErrors('Súčasné heslo nie je správne!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $my_account
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $my_account)
    {
        //
    }
}
