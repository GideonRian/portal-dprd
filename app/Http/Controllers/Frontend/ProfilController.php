<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;

class ProfilController extends Controller
{
    public function index(Request $request)
    {
        $query = Anggota::query();

        // 1. Filter Pencarian (Nama, Jabatan, Dapil)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('jabatan', 'like', "%{$search}%")
                  ->orWhere('dapil', 'like', "%{$search}%");
            });
        }

        // 2. Filter Komisi
        if ($request->filled('komisi')) {
            $query->where('komisi', $request->komisi);
        }

        // 3. Filter Badan (Gunakan whereJsonContains karena data bertipe JSON/Array)
        if ($request->filled('badan')) {
            $query->whereJsonContains('badan', $request->badan);
        }

        // Ambil data anggota terbaru
        $anggotas = $query->latest()->get();

        // List untuk Dropdown Filter
        $list_komisi = ['Komisi A', 'Komisi B', 'Komisi C'];
        $list_badan = [
            'Badan Anggaran (Banggar)',
            'Badan Musyawarah (Banmus)',
            'Badan Pembentukan Peraturan Daerah (Bapemperda)',
            'Badan Kehormatan (BK)'
        ];

        return view('Non-Users.profil-anggota', compact('anggotas', 'list_komisi', 'list_badan'));
    }

    // Pastikan Anda memiliki method ini untuk merespon fetch API dari Modal di View
    public function detail($id)
    {
        $anggota = Anggota::findOrFail($id);
        return response()->json($anggota);
    }
}