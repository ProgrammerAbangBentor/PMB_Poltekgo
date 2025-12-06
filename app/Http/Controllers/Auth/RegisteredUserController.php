<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\EntryPath;
use App\Models\StudyProgram;
use App\Models\PmbPeriod;
use App\Models\PmbWave;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Tampilkan halaman register
     */
    public function create()
    {
        return view('auth.register', [
            'jalurMasuk' => EntryPath::where('is_active', true)->get(),
            'prodiList'  => StudyProgram::where('is_active', true)->get(),
        ]);
    }

    /**
     * Proses registrasi
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'               => ['required', 'string', 'max:255'],
            'email'              => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:applicants,email'],
            'nik'                => ['required', 'digits:16', 'unique:applicants,nik'],
            'phone'              => ['nullable', 'string', 'max:20'],
            'password'           => ['required', 'confirmed', Rules\Password::defaults()],
            'entry_path_id'      => ['required', 'exists:entry_paths,id'],
            'study_program_id_1' => ['required', 'exists:study_programs,id'],
            'study_program_id_2' => ['required', 'exists:study_programs,id'],
        ]);

        // Periode aktif
        $periode = PmbPeriod::where('is_active', true)->first();

        // Gelombang aktif berdasarkan tanggal
        $gelombang = PmbWave::where('is_active', true)
            ->whereDate('tanggal_mulai', '<=', now())
            ->whereDate('tanggal_selesai', '>=', now())
            ->first();

        // Nomor pendaftaran otomatis
        $noPendaftaran = 'PMB-' . date('Y') . '-' . str_pad(
            (Applicant::max('id') ?? 0) + 1,
            4,
            '0',
            STR_PAD_LEFT
        );

        // Buat akun pendaftar
        $applicant = Applicant::create([
            'nama'        => $request->name,
            'email'       => $request->email,
            'nik'         => $request->nik,
            'no_hp'       => $request->phone,
            'password'    => Hash::make($request->password),
            'no_pendaftaran' => $noPendaftaran,

            'pmb_period_id' => $periode?->id,
            'pmb_wave_id'   => $gelombang?->id,

            'entry_path_id'     => $request->entry_path_id,
            'study_program_id'   => $request->study_program_id_1,
            'study_program_id_2' => $request->study_program_id_2,


            'is_biodata_complete'        => false,
            'is_documents_complete'      => false,
            'is_file_selection_passed'   => null,
            'is_entrance_selection_passed' => null,
            'is_lulus_final'             => false,
        ]);

        event(new Registered($applicant));

        Auth::guard('pendaftar')->login($applicant);

        return redirect()->route('pendaftar.dashboard');
    }
}
