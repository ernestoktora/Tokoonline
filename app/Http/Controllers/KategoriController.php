<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KategoriController extends Controller
{
    public function index()
    {
        $judul = 'Kategori';
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();

        return view('backend.v_kategori.index', compact('judul', 'kategori'));
    }

    public function create()
    {
        return view('backend.v_kategori.create', [
            'judul' => 'Kategori',
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|max:255|unique:kategori,nama_kategori',
        ]);

        Kategori::create($validatedData);

        return redirect()
            ->route('backend.kategori.index')
            ->with('success', 'Data berhasil tersimpan.');
    }

    public function edit(string $id)
    {
        return view('backend.v_kategori.edit', [
            'judul' => 'Kategori',
            'edit' => Kategori::findOrFail($id),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $kategori = Kategori::findOrFail($id);

        $validatedData = $request->validate([
            'nama_kategori' => [
                'required',
                'max:255',
                Rule::unique('kategori', 'nama_kategori')->ignore($kategori->id),
            ],
        ]);

        $kategori->update($validatedData);

        return redirect()
            ->route('backend.kategori.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()
            ->route('backend.kategori.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}