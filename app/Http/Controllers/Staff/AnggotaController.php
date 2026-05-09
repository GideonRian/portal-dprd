<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    // 1. Tampilkan Daftar Anggota (Read & Search)
    public function index(Request $request)
    {
        $search = $request->input('search');
        $anggotas = Anggota::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                         ->orWhere('jabatan', 'like', "%{$search}%")
                         ->orWhere('partai', 'like', "%{$search}%");
        })->latest()->get();

        return view('Staff.Anggota.index', compact('anggotas', 'search'));
    }

    // 2. Tampilkan Form Tambah (Create)
    public function create()
    {
        return view('Staff.Anggota.create');
    }

    // 3. Simpan Data Baru (Store)
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'jabatan' => 'required|string',
            'partai' => 'required|string',
            'komisi' => 'required|string',
            'badan' => 'nullable|string',
            'dapil' => 'required|string',
            'telepon' => 'nullable|string',
            'email' => 'nullable|email',
            'foto' => 'nullable|image|max:2048' // Maksimal 2MB
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('profil_anggota', 'public');
        }

        Anggota::create($data);
        return redirect()->route('staff.anggota.index')->with('success', 'Data anggota berhasil ditambahkan!');
    }

    // 4. Tampilkan Form Edit (Edit)
    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('Staff.Anggota.edit', compact('anggota'));
    }

    // 5. Simpan Perubahan (Update)
    public function update(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id);
        $data = $request->except(['_token', '_method']);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($anggota->foto) Storage::disk('public')->delete($anggota->foto);
            $data['foto'] = $request->file('foto')->store('profil_anggota', 'public');
        }

        $anggota->update($data);
        return redirect()->route('staff.anggota.index')->with('success', 'Data anggota berhasil diperbarui!');
    }

    // 6. Hapus Data (Delete)
    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        if ($anggota->foto) Storage::disk('public')->delete($anggota->foto);
        $anggota->delete();
        
        return redirect()->route('staff.anggota.index')->with('success', 'Data anggota berhasil dihapus!');
    }
}