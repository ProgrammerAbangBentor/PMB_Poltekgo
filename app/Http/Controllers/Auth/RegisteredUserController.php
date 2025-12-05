<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

use Illuminate\Support\Str;
// use Illuminate\Http\Request;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:applicants,email'],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // generate nomor pendaftaran sederhana
        $noPendaftaran = 'PMB-' . date('Y') . '-' . str_pad((Applicant::max('id') ?? 0) + 1, 4, '0', STR_PAD_LEFT);

        $applicant = Applicant::create([
            'nama'   => $request->name,
            'email'  => $request->email,
            'no_hp'  => $request->phone,
            'password' => Hash::make($request->password),
            'no_pendaftaran' => $noPendaftaran,

            // sementara null, nanti diisi dari pilihan form
            'pmb_period_id'     => null,
            'pmb_wave_id'       => null,
            'study_program_id'  => null,
            'entry_path_id'     => null,
        ]);

        Auth::guard('pendaftar')->login($applicant);

        return redirect()->route('pendaftar.dashboard');
    }
}
