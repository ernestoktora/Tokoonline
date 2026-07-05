<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\FotoProduk;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::with('kategori')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('backend.v_produk.index', [
            'judul' => 'Data Produk',
            'index' => $produk,
        ]);
    }

    public function create()
    {
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();

        return view('backend.v_produk.create', [
            'judul' => 'Tambah Produk',
            'kategori' => $kategori,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kategori_id' => 'required',
            'nama_produk' => 'required|max:255|unique:produk',
            'detail' => 'required',
            'harga' => 'required',
            'berat' => 'required',
            'stok' => 'required',
            'foto' => 'required|image|mimes:jpeg,jpg,png,gif|max:1024',
        ], [
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max' => 'Ukuran file gambar Maksimal adalah 1024 KB.'
        ]);

        $validatedData['status'] = 0;
        $validatedData['user_id'] = Auth::id();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'public/img-produk/';

            ImageHelper::uploadAndResize($file, $directory, $originalFileName);
            ImageHelper::uploadAndResize($file, $directory, 'thumb_lg_' . $originalFileName, 800, null);
            ImageHelper::uploadAndResize($file, $directory, 'thumb_md_' . $originalFileName, 500, 519);
            ImageHelper::uploadAndResize($file, $directory, 'thumb_sm_' . $originalFileName, 100, 110);

            $validatedData['foto'] = $originalFileName;
        }

        Produk::create($validatedData);
        return redirect()->route('backend.produk.index')->with('success', 'Data berhasil tersimpan');
    }

    public function show(string $id)
    {
        $produk = Produk::with('gambar')->findOrFail($id);
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();

        return view('backend.v_produk.show', [
            'judul' => 'Detail Produk',
            'show' => $produk,
            'kategori' => $kategori,
        ]);
    }

    public function edit(string $id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();

        return view('backend.v_produk.edit', [
            'judul' => 'Ubah Produk',
            'edit' => $produk,
            'kategori' => $kategori,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $produk = Produk::findOrFail($id);
        $validatedData = $request->validate([
            'nama_produk' => 'required|max:255|unique:produk,nama_produk,' . $id,
            'kategori_id' => 'required',
            'status' => 'required',
            'detail' => 'required',
            'harga' => 'required',
            'berat' => 'required',
            'stok' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ], [
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max' => 'Ukuran file gambar Maksimal adalah 1024 KB.'
        ]);

        $validatedData['user_id'] = Auth::id();

        if ($request->hasFile('foto')) {
            if ($produk->foto) {
                $oldImagePath = public_path('storage/img-produk/' . $produk->foto);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }

                $oldThumbnailLg = public_path('storage/img-produk/' . 'thumb_lg_' . $produk->foto);
                if (file_exists($oldThumbnailLg)) {
                    unlink($oldThumbnailLg);
                }

                $oldThumbnailMd = public_path('storage/img-produk/' . 'thumb_md_' . $produk->foto);
                if (file_exists($oldThumbnailMd)) {
                    unlink($oldThumbnailMd);
                }

                $oldThumbnailSm = public_path('storage/img-produk/' . 'thumb_sm_' . $produk->foto);
                if (file_exists($oldThumbnailSm)) {
                    unlink($oldThumbnailSm);
                }
            }

            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'public/img-produk/';

            ImageHelper::uploadAndResize($file, $directory, $originalFileName);
            ImageHelper::uploadAndResize($file, $directory, 'thumb_lg_' . $originalFileName, 800, null);
            ImageHelper::uploadAndResize($file, $directory, 'thumb_md_' . $originalFileName, 500, 519);
            ImageHelper::uploadAndResize($file, $directory, 'thumb_sm_' . $originalFileName, 100, 110);

            $validatedData['foto'] = $originalFileName;
        }

        $produk->update($validatedData);

        return redirect()->route('backend.produk.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);
        $directory = public_path('storage/img-produk/');

        if ($produk->foto) {
            $oldImagePath = $directory . $produk->foto;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            $thumbnailLg = $directory . 'thumb_lg_' . $produk->foto;
            if (file_exists($thumbnailLg)) {
                unlink($thumbnailLg);
            }

            $thumbnailMd = $directory . 'thumb_md_' . $produk->foto;
            if (file_exists($thumbnailMd)) {
                unlink($thumbnailMd);
            }

            $thumbnailSm = $directory . 'thumb_sm_' . $produk->foto;
            if (file_exists($thumbnailSm)) {
                unlink($thumbnailSm);
            }
        }

        // Hapus foto produk lainnya di tabel foto_produk
        $fotoProduks = FotoProduk::where('produk_id', $id)->get();
        foreach ($fotoProduks as $fotoProduk) {
            $fotoPath = $directory . $fotoProduk->foto;
            if (file_exists($fotoPath)) {
                unlink($fotoPath);
            }
            $fotoProduk->delete();
        }

        $produk->delete();

        return redirect()->route('backend.produk.index')->with('success', 'Data berhasil dihapus');
    }

    // Method untuk menyimpan foto tambahan
    public function storeFoto(Request $request)
    {
        // Validasi input
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'foto_produk.*' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ]);

        if ($request->hasFile('foto_produk')) {
            foreach ($request->file('foto_produk') as $file) {
                // Buat nama file yang unik
                $extension = $file->getClientOriginalExtension();
                $filename = date('YmdHis') . '_' . uniqid() . '.' . $extension;
                $directory = 'public/img-produk/';

                // Simpan dan resize gambar menggunakan ImageHelper
                ImageHelper::uploadAndResize($file, $directory, $filename, 800, null);

                // Simpan data ke database
                FotoProduk::create([
                    'produk_id' => $request->produk_id,
                    'foto' => $filename,
                ]);
            }
        }

        return redirect()->route('backend.produk.show', $request->produk_id)
            ->with('success', 'Foto berhasil ditambahkan.');
    }

    // Method untuk menghapus foto
    public function destroyFoto(string $id)
    {
        $foto = FotoProduk::findOrFail($id);
        $produkId = $foto->produk_id;

        // Hapus file gambar dari storage
        $imagePath = public_path('storage/img-produk/' . $foto->foto);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Hapus record dari database
        $foto->delete();

        return redirect()->route('backend.produk.show', $produkId)
            ->with('success', 'Foto berhasil dihapus.');
    }

    // Method untuk Form Laporan Produk
    public function formProduk()
    {
        return view('backend.v_produk.form', [
            'judul' => 'Laporan Data Produk',
        ]);
    }

    // Method untuk Cetak Laporan Produk
    public function cetakProduk(Request $request)
    {
        // Menambahkan aturan validasi
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

        // Note: Modul menggunakan whereBetween, namun kita gunakan whereDate 
        // agar data pada hari terakhir tidak terpotong (bug pada modul).
        $query = Produk::whereDate('updated_at', '>=', $tanggalAwal)
            ->whereDate('updated_at', '<=', $tanggalAkhir)
            ->orderBy('id', 'desc');

        $produk = $query->get();

        return view('backend.v_produk.cetak', [
            'judul' => 'Laporan Produk',
            'tanggalAwal' => $tanggalAwal,
            'tanggalAkhir' => $tanggalAkhir,
            'cetak' => $produk,
        ]);
    }
}