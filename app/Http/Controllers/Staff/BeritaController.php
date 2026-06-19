<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\ActivityLog; 
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
            'gambar' => 'required|array|min:1|max:5', 
            'gambar.*' => 'image|max:2048',
        ]);

        try {
            $data['slug'] = Str::slug($request->judul) . '-' . time();
            $data['is_featured'] = $request->has('is_featured');

            $imagePaths = [];
            if ($request->hasFile('gambar')) {
                foreach ($request->file('gambar') as $file) {
                    $imagePaths[] = $file->store('berita_gambar', 'public');
                }
            }
            $data['gambar'] = $imagePaths;

            // Simpan ke variabel $berita agar datanya bisa diambil
            $berita = Berita::create($data);

            // CATAT LOG SUKSES (Merekam Data Baru / After)
            ActivityLog::record('Berita', 'CREATE_BERITA', "Staf mempublikasikan berita baru: {$request->judul}", 'success', null, $berita->toArray());

            return redirect()->route('staff.berita.index')->with('success', 'Berita berhasil dipublikasikan!');

        } catch (\Exception $e) {
            
            // CATAT LOG GAGAL
            ActivityLog::record('Berita', 'FAILED_CREATE_BERITA', "Gagal mempublikasikan berita baru. Error: " . $e->getMessage(), 'error');
            
            return back()->withInput()->with('error', 'Terjadi kesalahan sistem saat menyimpan berita!');
        }
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
            'gambar' => 'nullable|array|max:5', 
            'gambar.*' => 'image|max:2048',
        ]);

        try {
            // 1. AMBIL DATA LAMA (Sebelum diupdate)
            $oldData = $berita->getOriginal();

            $data['slug'] = Str::slug($request->judul) . '-' . time();
            $data['is_featured'] = $request->has('is_featured');

            if ($request->hasFile('gambar')) {
                // Hapus gambar lama
                if (is_array($berita->gambar)) {
                    foreach ($berita->gambar as $oldImage) {
                        if(Storage::disk('public')->exists($oldImage)) {
                             Storage::disk('public')->delete($oldImage);
                        }
                    }
                }
                
                // Simpan gambar baru
                $imagePaths = [];
                foreach ($request->file('gambar') as $file) {
                    $imagePaths[] = $file->store('berita_gambar', 'public');
                }
                $data['gambar'] = $imagePaths;
            } else {
                unset($data['gambar']);
            }

            $berita->update($data);

            // 2. AMBIL DATA BARU (Setelah diupdate)
            $newData = $berita->getChanges();

            // CATAT LOG SUKSES (Merekam Data Lama vs Data Baru)
            ActivityLog::record('Berita', 'UPDATE_BERITA', "Staf memperbarui data berita: {$request->judul}", 'success', $oldData, $newData);

            return redirect()->route('staff.berita.index')->with('success', 'Berita berhasil diperbarui!');

        } catch (\Exception $e) {
            
            // CATAT LOG GAGAL
            ActivityLog::record('Berita', 'FAILED_UPDATE_BERITA', "Gagal memperbarui berita (ID: {$id}). Error: " . $e->getMessage(), 'error');
            
            return back()->withInput()->with('error', 'Terjadi kesalahan sistem saat memperbarui berita!');
        }
    }

    public function destroy($id)
    {
        try {
            $berita = Berita::findOrFail($id);
            $judulBerita = $berita->judul; 

            // 1. AMBIL DATA LAMA (Untuk dicatat sebelum dilenyapkan)
            $oldData = $berita->toArray();

            if (is_array($berita->gambar)) {
                foreach ($berita->gambar as $img) {
                    if(Storage::disk('public')->exists($img)) {
                        Storage::disk('public')->delete($img);
                    }
                }
            }
            $berita->delete();

            // CATAT LOG WARNING (Merekam Data Lama yang Dihapus)
            ActivityLog::record('Berita', 'DELETE_BERITA', "Staf menghapus berita berjudul: {$judulBerita}", 'warning', $oldData, null);

            return redirect()->route('staff.berita.index')->with('success', 'Berita berhasil dihapus!');

        } catch (\Exception $e) {
            
            // CATAT LOG GAGAL
            ActivityLog::record('Berita', 'FAILED_DELETE_BERITA', "Gagal menghapus berita (ID: {$id}). Error: " . $e->getMessage(), 'error');
            
            return back()->with('error', 'Terjadi kesalahan sistem saat menghapus berita!');
        }
    }

    public function toggleFeatured($id)
    {
        try {
            $berita = Berita::findOrFail($id);
            
            // 1. AMBIL DATA LAMA
            $oldData = $berita->getOriginal();
            
            $berita->update(['is_featured' => !$berita->is_featured]);

            // 2. AMBIL DATA BARU
            $newData = $berita->getChanges();

            // Tentukan status untuk pesan log
            $statusUnggulan = $berita->is_featured ? 'menjadi unggulan' : 'dihapus dari daftar unggulan';
            
            // CATAT LOG SUKSES (Merekam Perubahan)
            ActivityLog::record('Berita', 'TOGGLE_FEATURED_BERITA', "Staf mengubah status berita '{$berita->judul}' {$statusUnggulan}", 'success', $oldData, $newData);

            return back()->with('success', 'Status unggulan berita diperbarui!');

        } catch (\Exception $e) {
            
            // CATAT LOG GAGAL
            ActivityLog::record('Berita', 'FAILED_TOGGLE_FEATURED', "Gagal mengubah status unggulan berita (ID: {$id}). Error: " . $e->getMessage(), 'error');
            
            return back()->with('error', 'Terjadi kesalahan sistem saat mengubah status unggulan!');
        }
    }
}