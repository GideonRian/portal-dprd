<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\ActivityLog; 
use Illuminate\Support\Facades\Storage;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        // Logika Otomatisasi Status: 
        \App\Models\Agenda::where('status', 'Akan Datang')
            ->where('tanggal', '<', now()->toDateString())
            ->update(['status' => 'Selesai']);

        $search = $request->input('search');
        $kategori = $request->input('kategori');

        $stats = [
            'total' => Agenda::count(),
            'mendatang' => Agenda::where('status', 'Akan Datang')->count(),
            'selesai' => Agenda::where('status', 'Selesai')->count(),
        ];

        $agendas = Agenda::when($search, function($q) use ($search) {
            return $q->where('judul', 'like', "%$search%");
        })->when($kategori && $kategori !== 'Semua Kategori', function($q) use ($kategori) {
            return $q->where('kategori', $kategori);
        })->latest('tanggal')->get();

        return view('Staff.Agenda.index', compact('agendas', 'stats', 'search', 'kategori'));
    }

    public function create() { return view('Staff.Agenda.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required|string',
            'status' => 'required|string',
            'lokasi' => 'required|string',
            'kategori' => 'required|string',
            'peserta' => 'required|string',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|max:2048',
        ]);

        try {
            if ($request->hasFile('gambar')) {
                $data['gambar'] = $request->file('gambar')->store('agenda_files', 'public');
            }

            Agenda::create($data);

            // CATAT LOG SUKSES
            ActivityLog::record('Agenda', 'CREATE_AGENDA', "Staf menambahkan agenda baru: {$data['judul']}", 'success');

            return redirect()->route('staff.agenda.index')->with('success', 'Agenda berhasil ditambahkan!');

        } catch (\Exception $e) {
            
            // CATAT LOG GAGAL
            ActivityLog::record('Agenda', 'FAILED_CREATE_AGENDA', "Gagal menambah agenda baru. Error: " . $e->getMessage(), 'error');
            
            return back()->withInput()->with('error', 'Terjadi kesalahan sistem saat menyimpan agenda!');
        }
    }

    public function edit(Agenda $agenda) { return view('Staff.Agenda.edit', compact('agenda')); }

    public function update(Request $request, Agenda $agenda)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required|string',
            'status' => 'required|string',
            'lokasi' => 'required|string',
            'kategori' => 'required|string',
            'peserta' => 'required|string',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|max:2048',
        ]);

        try {
            if ($request->hasFile('gambar')) {
                if ($agenda->gambar) Storage::disk('public')->delete($agenda->gambar);
                $data['gambar'] = $request->file('gambar')->store('agenda_files', 'public');
            }

            $agenda->update($data);

            // CATAT LOG SUKSES
            ActivityLog::record('Agenda', 'UPDATE_AGENDA', "Staf memperbarui data agenda: {$data['judul']}", 'success');

            return redirect()->route('staff.agenda.index')->with('success', 'Agenda berhasil diperbarui!');

        } catch (\Exception $e) {
            
            // CATAT LOG GAGAL
            ActivityLog::record('Agenda', 'FAILED_UPDATE_AGENDA', "Gagal memperbarui agenda (ID: {$agenda->id}). Error: " . $e->getMessage(), 'error');
            
            return back()->withInput()->with('error', 'Terjadi kesalahan sistem saat memperbarui agenda!');
        }
    }
    
    public function show(Agenda $agenda)
    {
        return view('Staff.Agenda.show', compact('agenda'));
    }

    public function destroy(Agenda $agenda)
    {
        try {
            $judulAgenda = $agenda->judul; 

            if ($agenda->gambar) Storage::disk('public')->delete($agenda->gambar);
            $agenda->delete();

            // CATAT LOG WARNING (Tindakan Destruktif)
            ActivityLog::record('Agenda', 'DELETE_AGENDA', "Staf menghapus agenda: {$judulAgenda}", 'warning');

            return redirect()->route('staff.agenda.index')->with('success', 'Agenda berhasil dihapus!');

        } catch (\Exception $e) {
            
            // CATAT LOG GAGAL
            ActivityLog::record('Agenda', 'FAILED_DELETE_AGENDA', "Gagal menghapus agenda (ID: {$agenda->id}). Error: " . $e->getMessage(), 'error');
            
            return back()->with('error', 'Terjadi kesalahan sistem saat menghapus agenda!');
        }
    }
}