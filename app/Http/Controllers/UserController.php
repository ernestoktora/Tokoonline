<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

            $directory = 'backend/matrix-admin-master/assets/images/img-user/';

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
        return view('backend.v_user.edit');
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}