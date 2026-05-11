<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kategori = $request->input('kategori');

        $beritas = Berita::when($search, function ($query, $search) {
            return $query->where('judul', 'like', "%{$search}%")->orWhere('ringkasan', 'like', "%{$search}%");
        })->when($kategori && $kategori !== 'Semua', function ($query) use ($kategori) {
            return $query->where('kategori', $kategori);
        })->latest()->get();

        return view('Staff.Berita.index', compact('beritas', 'search', 'kategori'));
    }

    public function create() { return view('Staff.Berita.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'kategori' => 'required|string',
            'ringkasan' => 'required|string',
            'konten' => 'required|string',
            'gambar' => 'required|array|min:1|max:5', // WAJIB, min 1, max 5 foto
            'gambar.*' => 'image|max:2048',
        ]);

        $data['slug'] = Str::slug($request->judul) . '-' . time();
        $data['is_featured'] = $request->has('is_featured');

        $imagePaths = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $imagePaths[] = $file->store('berita_gambar', 'public');
            }
        }
        $data['gambar'] = $imagePaths;

        Berita::create($data);
        return redirect()->route('staff.berita.index')->with('success', 'Berita berhasil dipublikasikan!');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('Staff.Berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'kategori' => 'required|string',
            'ringkasan' => 'required|string',
            'konten' => 'required|string',
            'gambar' => 'nullable|array|max:5', // Di form edit boleh kosong (jika tak ganti foto)
            'gambar.*' => 'image|max:2048',
        ]);

        $data['slug'] = Str::slug($request->judul) . '-' . time();
        $data['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('gambar')) {
            if (is_array($berita->gambar)) {
                foreach ($berita->gambar as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            $imagePaths = [];
            foreach ($request->file('gambar') as $file) {
                $imagePaths[] = $file->store('berita_gambar', 'public');
            }
            $data['gambar'] = $imagePaths;
        } else {
            unset($data['gambar']);
        }

        $berita->update($data);
        return redirect()->route('staff.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        if (is_array($berita->gambar)) {
            foreach ($berita->gambar as $img) {
                Storage::disk('public')->delete($img);
            }
        }
        $berita->delete();
        return redirect()->route('staff.berita.index')->with('success', 'Berita berhasil dihapus!');
    }

    public function toggleFeatured($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->update(['is_featured' => !$berita->is_featured]);
        return back()->with('success', 'Status unggulan berita diperbarui!');
    }
}