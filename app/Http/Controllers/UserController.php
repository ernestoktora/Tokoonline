<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $judul = 'Data User';
        $users = User::all();

        return view('backend.v_user.index', compact('judul', 'users'));
    }

    public function create()
    {
        return view('backend.v_user.create', [
            'judul' => 'Tambah User',
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nama'     => 'required|max:255',
                'email' => 'required|max:255|email|unique:user,email',
                'role'     => 'required',
                'hp'       => 'required|digits_between:10,13',
                'password' => 'required|min:4|confirmed',
                'foto'     => 'nullable|image|mimes:jpeg,jpg,png,gif|max:1024',
            ],
            [
                'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
                'foto.max'   => 'Ukuran file gambar maksimal adalah 1024 KB.',
            ]
        );

        $validatedData['status'] = 0;

        // Upload dan resize gambar
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();

            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;

            $directory = 'public/img-user/';

            ImageHelper::uploadAndResize(
                $file,
                $directory,
                $originalFileName,
                385,
                400
            );

            $validatedData['foto'] = $originalFileName;
        }

        // Validasi kombinasi password
        $password = $request->password;

        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/';

        if (!preg_match($pattern, $password)) {
            return redirect()
                ->back()
                ->withErrors([
                    'password' => 'Password harus terdiri dari kombinasi huruf besar, huruf kecil, angka, dan simbol karakter.'
                ])
                ->withInput();
        }

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect()
            ->route('backend.user.index')
            ->with('success', 'Data berhasil tersimpan.');
    }

    public function edit(string $id)
    {
        return view('backend.v_user.edit', [
            'judul' => 'Ubah User',
            'user' => User::findOrFail($id),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'email' => ['required', 'max:255', 'email', Rule::unique('user', 'email')->ignore($user->id)],
            'role' => 'required',
            'status' => 'required',
            'hp' => 'required|digits_between:10,13',
            'password' => 'nullable|min:4|confirmed',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:1024',
        ], [
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max' => 'Ukuran file gambar maksimal adalah 1024 KB.',
        ]);

        if ($request->hasFile('foto')) {
            $directory = 'public/img-user/';
            if ($user->foto && file_exists(public_path('storage/img-user/' . $user->foto))) {
                unlink(public_path('storage/img-user/' . $user->foto));
            }

            $file = $request->file('foto');
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400);
            $validatedData['foto'] = $originalFileName;
        }

        if ($request->filled('password')) {
            $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/';
            if (!preg_match($pattern, $request->password)) {
                return redirect()->back()->withErrors([
                    'password' => 'Password harus terdiri dari kombinasi huruf besar, huruf kecil, angka, dan simbol karakter.'
                ])->withInput();
            }
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect()->route('backend.user.index')->with('success', 'Data berhasil diubah.');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if ($user->foto && file_exists(public_path('storage/img-user/' . $user->foto))) {
            unlink(public_path('storage/img-user/' . $user->foto));
        }

        $user->delete();
        return redirect()->route('backend.user.index')->with('success', 'Data berhasil dihapus.');
    }

    public function formUser()
    {
        return view('backend.v_user.form', [
            'judul' => 'Laporan Data User',
        ]);
    }

    public function cetakUser(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ], [
            'tanggal_awal.required' => 'Tanggal Awal harus diisi.',
            'tanggal_akhir.required' => 'Tanggal Akhir harus diisi.',
            'tanggal_akhir.after_or_equal' => 'Tanggal Akhir harus lebih besar atau sama dengan Tanggal Awal.',
        ]);

        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $user = User::whereDate('created_at', '>=', $tanggalAwal)
            ->whereDate('created_at', '<=', $tanggalAkhir)
            ->orderBy('id', 'desc')
            ->get();

        return view('backend.v_user.cetak', [
            'judul' => 'Laporan User',
            'tanggalAwal' => $tanggalAwal,
            'tanggalAkhir' => $tanggalAkhir,
            'cetak' => $user,
        ]);
    }
}