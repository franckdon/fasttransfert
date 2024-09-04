<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Domaine;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $domaines = Domaine::orderBy('name', 'asc')->get();
        return view('auth.register', ([
            'domaines' => $domaines
        ]));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'telephone' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'domaine_id' => ['required', 'exists:domaines,id'],
        ]);

        //dd($request->all());

        $roleUser = Role::where('name', 'client')->first();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'domaine_id' => $request->domaine_id,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($roleUser);

        event(new Registered($user));

        Auth::login($user);

        if ($user->roles->contains('name', 'client')) {
            return redirect(route('dashboard', absolute: false));
        } else {
            return redirect(route('dashboard', absolute: false));
        }
    }
}
