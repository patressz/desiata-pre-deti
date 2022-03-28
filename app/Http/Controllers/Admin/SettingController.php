<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateDeadlineRequest;

class SettingController extends Controller
{
    public function index()
    {
        $registration = Setting::where('name', 'registration')->first();
        $deadline = Setting::where('name', 'deadline')->first();

        return view('admin.settings', compact('registration', 'deadline') );
    }

    public function update_registration(Request $request)
    {
        if ( $request->status == 0 || $request->status == 1 ) {

            Setting::where('name', 'registration')->update([
                'value' => $request->status
            ]);

            if ( $request->status == 0 ) {
                return redirect()->route('settings')->withStatus('Registrácia bola úspešne zakázaná.');
            } else {
                return redirect()->route('settings')->withStatus('Registrácia bola úspešne povolená.');
            }

        } else {
            return redirect()->route('settings')->withErrors('Niečo sa pokazilo, skúste to znova.');
        }
    }

    public function update_deadline(UpdateDeadlineRequest $request)
    {
        Setting::where('name', 'deadline')->update([
            'value' => $request->time
        ]);

        return redirect()->route('settings')->withStatus('Uzavierka bola úspešne aktualizovaná.');
    }
}
