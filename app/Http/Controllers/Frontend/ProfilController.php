use App\Models\Anggota;

public function index()
{
    // Mengambil semua data anggota terbaru
    $anggotas = Anggota::latest()->get();
    return view('Non-Users.profil-anggota', compact('anggotas'));
}