<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\ActivityLog; 
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

        try {
            if ($request->hasFile('foto')) {
                $validated['foto'] = $request->file('foto')->store('anggota_fotos', 'public');
            }

            Anggota::create($validated);

            // CATAT LOG SUKSES
            ActivityLog::record('Anggota', 'CREATE_ANGGOTA', "Staf menambahkan profil anggota dewan: {$validated['nama']}", 'success');

            return redirect()->route('staff.anggota.index')->with('success', 'Data Anggota berhasil ditambahkan!');

        } catch (\Exception $e) {
            
            // CATAT LOG GAGAL
            ActivityLog::record('Anggota', 'FAILED_CREATE_ANGGOTA', "Gagal menambahkan data anggota. Error: " . $e->getMessage(), 'error');
            
            return back()->withInput()->with('error', 'Terjadi kesalahan sistem saat menyimpan data anggota!');
        }
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

        try {
            if ($request->hasFile('foto')) {
                if ($anggota->foto && Storage::disk('public')->exists($anggota->foto)) {
                    Storage::disk('public')->delete($anggota->foto);
                }
                $validated['foto'] = $request->file('foto')->store('anggota_fotos', 'public');
            }

            $anggota->update($validated);

            // CATAT LOG SUKSES
            ActivityLog::record('Anggota', 'UPDATE_ANGGOTA', "Staf memperbarui profil anggota dewan: {$validated['nama']}", 'success');

            return redirect()->route('staff.anggota.index')->with('success', 'Data Anggota berhasil diperbarui!');

        } catch (\Exception $e) {
            
            // CATAT LOG GAGAL
            ActivityLog::record('Anggota', 'FAILED_UPDATE_ANGGOTA', "Gagal memperbarui data anggota (ID: {$id}). Error: " . $e->getMessage(), 'error');
            
            return back()->withInput()->with('error', 'Terjadi kesalahan sistem saat memperbarui data anggota!');
        }
    }

    // 6. Hapus Data
    public function destroy($id)
    {
        try {
            $anggota = Anggota::findOrFail($id);
            $namaAnggota = $anggota->nama; // Simpan nama sebelum dihapus untuk log

            if ($anggota->foto) {
                Storage::disk('public')->delete($anggota->foto);
            }
            $anggota->delete();
            
            // CATAT LOG WARNING (Tindakan Destruktif)
            ActivityLog::record('Anggota', 'DELETE_ANGGOTA', "Staff menghapus data anggota dewan: {$namaAnggota}", 'warning');

            return redirect()->route('staff.anggota.index')->with('success', 'Data anggota berhasil dihapus!');

        } catch (\Exception $e) {
            
            // CATAT LOG GAGAL
            ActivityLog::record('Anggota', 'FAILED_DELETE_ANGGOTA', "Gagal menghapus data anggota (ID: {$id}). Error: " . $e->getMessage(), 'error');
            
            return back()->with('error', 'Terjadi kesalahan sistem saat menghapus data anggota!');
        }
    }
}