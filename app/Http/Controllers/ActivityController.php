<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Activity;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    // Menampilkan semua aktivitas
    public function index()
    {
        $activities = Activity::all();
        return view('activities.index', compact('activities'));
    }

    // Menampilkan form untuk membuat aktivitas baru
    public function create()
    {
        return view('activities.create');
    }

    // Menyimpan aktivitas yang baru dibuat
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'rencana_aktifitas' => 'required',
            'laporan_aktifitas' => 'required',
            'progres_harian' => 'required',
            'foto1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Contoh validasi untuk foto1
            'foto2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Contoh validasi untuk foto2
        ]);

        // Simpan aktivitas ke dalam database
        $activity = Activity::create($request->all());

        // Jika ada foto yang diunggah, simpan foto ke dalam penyimpanan
        if ($request->hasFile('foto1')) {
            $foto1Path = $request->file('foto1')->store('foto1');
            $activity->foto1 = $foto1Path;
        }

        if ($request->hasFile('foto2')) {
            $foto2Path = $request->file('foto2')->store('foto2');
            $activity->foto2 = $foto2Path;
        }

        $activity->save();

        return redirect()->route('activities.index')->with('success', 'Aktivitas berhasil disimpan.');
    }

    // Menampilkan detail aktivitas
    public function show(Activity $activity)
    {
        return view('activities.show', compact('activity'));
    }

    // Menampilkan form untuk mengedit aktivitas
    public function edit(Activity $activity)
    {
        return view('activities.edit', compact('activity'));
    }

    // Menyimpan aktivitas yang telah diedit
    public function update(Request $request, Activity $activity)
    {
        // Validasi input dari form
        $request->validate([
            'rencana_aktifitas' => 'required',
            'laporan_aktifitas' => 'required',
            'progres_harian' => 'required',
            'foto1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Contoh validasi untuk foto1
            'foto2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Contoh validasi untuk foto2
        ]);

        // Update aktivitas dengan data baru
        $activity->update($request->all());

        // Jika ada foto yang diunggah, simpan foto ke dalam penyimpanan
        if ($request->hasFile('foto1')) {
            $foto1Path = $request->file('foto1')->store('foto1');
            $activity->foto1 = $foto1Path;
        }

        if ($request->hasFile('foto2')) {
            $foto2Path = $request->file('foto2')->store('foto2');
            $activity->foto2 = $foto2Path;
        }

        $activity->save();

        return redirect()->route('activities.index')->with('success', 'Aktivitas berhasil diperbarui.');
    }

    // Menghapus aktivitas
    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect()->route('activities.index')->with('success', 'Aktivitas berhasil dihapus.');
    }

    public function checkIn(Request $request)
    {
        // Validasi input jika diperlukan
        $request->validate([
            'deskripsi' => 'required|string',
        ]);

        $inputText = $request->input('deskripsi');

        // Memisahkan teks menjadi array berdasarkan baris
        $lines = explode(PHP_EOL, $inputText);

        // Menghapus spasi tambahan di awal dan akhir setiap baris
        $lines = array_map('trim', $lines);

        // Menggabungkan baris dengan spasi di antaranya
        $formattedText = implode(PHP_EOL, $lines);

        // Simpan data check-in ke dalam database
        Activity::create([
            'id_user' => auth()->user()->id,
            'rencana_aktifitas' => $formattedText,
            'created_at' => now(),
            // Tambahkan kolom-kolom lain yang sesuai dengan kebutuhan Anda

        ]);

        // Redirect kembali ke halaman check-in dengan pesan sukses
        return redirect()->back();
    }

    public function checkOut(Request $request)
    {
        // Lakukan pemrosesan saat check-out
        // Validasi form jika diperlukan
        $request->validate([
            'foto1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Sesuaikan dengan kebutuhan Anda
            'foto2' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Sesuaikan dengan kebutuhan Anda
        ]);

        // Menyimpan foto1
        if ($request->hasFile('foto1')) {
            $foto1Path = $request->file('foto1')->store('checkout_photos'); // Simpan foto1 dengan path 'checkout_photos'
        }

        // Menyimpan foto2
        if ($request->hasFile('foto2')) {
            $foto2Path = $request->file('foto2')->store('checkout_photos'); // Simpan foto2 dengan path 'checkout_photos'
        }

        // Menggunakan DB Facade untuk menyimpan path foto1 dan foto2 ke dalam tabel database
        DB::table('activity')->whereDate('created_at', now()->toDateString())
            ->where('id_user', auth()->id())
            ->update([
                'foto1' => $foto1Path ?? null,
                // Menggunakan null jika tidak ada foto1
                'foto2' => $foto2Path ?? null,
                // Menggunakan null jika tidak ada foto2
            ]);

        // Misalnya, simpan data check-out ke dalam database
        $checkInToday = Activity::where('id_user', auth()->user()->id)
            ->whereDate('created_at', today())
            ->firstOrFail();

        $checkInTodaytemp = $checkInToday->rencana_aktifitas;
        $inputText = $request->input('deskripsi');

        // Memisahkan teks menjadi array berdasarkan baris
        $lines = explode(PHP_EOL, $inputText);

        // Menghapus spasi tambahan di awal dan akhir setiap baris
        $lines = array_map('trim', $lines);

        // Menggabungkan baris dengan spasi di antaranya
        $formattedText = implode(PHP_EOL, $lines);




        // Simpan waktu check-out ke dalam database
        $checkInToday->updated_at = now();
        $checkInToday->rencana_aktifitas = $checkInTodaytemp;
        $checkInToday->laporan_aktifitas = $formattedText; // Ubah deskripsi menjadi laporan
        $checkInToday->progres_harian = $request->input('skala_progress'); // Tambahkan kolom-kolom lain yang sesuai dengan kebutuhan Anda



        if ($request->hasFile('foto1')) {
            $checkInToday->foto1 = $request->file('foto1')->store('public/checkout_photos');
        }

        if ($request->hasFile('foto2')) {
            $checkInToday->foto2 = $request->file('foto2')->store('public/checkout_photos');
        }


        $checkInToday->save();

        // Redirect kembali ke halaman check-in dengan pesan sukses
        return redirect()->back()->with('success', 'Check-out berhasil.');
    }
    public function showActivity()
    {
        $activityUser = Activity::where('id_user', auth()->user()->id)->get();
        $activities = Activity::all();
        return view('ui.aktivitas', compact('activityUser', 'activities'));
    }
    public function showUser()
    {
        $user = User::all();
        return view('ui.users', compact('user'));
    }
    // fungsi untuk show activity
}
