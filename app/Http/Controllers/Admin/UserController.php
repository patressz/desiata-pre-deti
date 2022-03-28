<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserRequest;
use App\Notifications\GenerateNewPassword;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users');
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.edit-user', compact('user', 'roles') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if ( auth()->user()->role->id == 3 ) {

            if ( $request->role == 1 || $request->role == 2 || $request->role == 3 ) {

                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'role_id' => $request->role,
                    'money' => $request->credit,
                ]);

                return redirect()->route('users.index')->withStatus('Používateľ bol úspešne aktualizovaný.');
            } else {
                return redirect()->route('users.index')->withErrors('Niečo sa pokazilo, skúste to znova.');
            }
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'money' => $request->credit,
            ]);

            return redirect()->route('users.index')->withStatus('Používateľ bol úspešne aktualizovaný.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->withStatus('Používateľ bol úspešne odstránený.');
    }

    public function generate_new_password(User $user)
    {
        $random = str_random(12);
        $hashed_random_password = Hash::make($random);

        $user->update([
            'password' => $hashed_random_password,
        ]);

        $user->notify(new GenerateNewPassword($user, $random));

        return redirect()->route('users.index')->withStatus(new HtmlString("Nové heslo pre používateľa <strong>$user->name</strong> bolo úspešne vygenerované."));
    }
}
