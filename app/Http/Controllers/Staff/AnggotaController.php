<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    // 1. Tampilkan Daftar Anggota
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

    // 2. Tampilkan Form Tambah
    public function create()
    {
        return view('Staff.Anggota.create');
    }

    // 3. Simpan Data Baru
    public function store(Request $request)
    {
        // 1. Validasi semua input (termasuk yang baru)
        $validated = $request->validate([
            'nama'                => 'required|string|max:255',
            'jabatan'             => 'required|string|max:255',
            'partai'              => 'required|string|max:255',
            'dapil'               => 'required|string|max:255',
            'komisi'              => 'nullable|string',
            'jabatan_komisi'      => 'nullable|string',
            'badan'               => 'nullable|string',
            'jabatan_badan'       => 'nullable|string',
            'tanggal_lahir'       => 'nullable|date',
            'telepon'             => 'nullable|string',
            'email'               => 'nullable|email',
            'riwayat_pendidikan'  => 'nullable|string',
            'riwayat_pekerjaan'   => 'nullable|string',
            'riwayat_penghargaan' => 'nullable|string',
            'foto'                => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Proses upload foto jika ada
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('anggota_fotos', 'public');
        }

        // 3. Simpan ke database
        Anggota::create($validated);

        return redirect()->route('staff.anggota.index')->with('success', 'Data Anggota berhasil ditambahkan!');
    }

    // 4. Tampilkan Form Edit
    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('Staff.Anggota.edit', compact('anggota'));
    }

    // 5. Simpan Perubahan
    public function update(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id);

        // 1. Validasi semua input
        $validated = $request->validate([
            'nama'                => 'required|string|max:255',
            'jabatan'             => 'required|string|max:255',
            'partai'              => 'required|string|max:255',
            'dapil'               => 'required|string|max:255',
            'komisi'              => 'nullable|string',
            'jabatan_komisi'      => 'nullable|string',
            'badan'               => 'nullable|string',
            'jabatan_badan'       => 'nullable|string',
            'tanggal_lahir'       => 'nullable|date',
            'telepon'             => 'nullable|string',
            'email'               => 'nullable|email',
            'riwayat_pendidikan'  => 'nullable|string',
            'riwayat_pekerjaan'   => 'nullable|string',
            'riwayat_penghargaan' => 'nullable|string',
            'foto'                => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Proses foto baru jika diupload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($anggota->foto && Storage::disk('public')->exists($anggota->foto)) {
                Storage::disk('public')->delete($anggota->foto);
            }
            $validated['foto'] = $request->file('foto')->store('anggota_fotos', 'public');
        }

        // 3. Update database
        $anggota->update($validated);

        return redirect()->route('staff.anggota.index')->with('success', 'Data Anggota berhasil diperbarui!');
    }

    // 6. Hapus Data
    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        if ($anggota->foto) {
            Storage::disk('public')->delete($anggota->foto);
        }
        $anggota->delete();
        
        return redirect()->route('staff.anggota.index')->with('success', 'Data anggota berhasil dihapus!');
    }
}