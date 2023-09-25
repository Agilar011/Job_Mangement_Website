<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;

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
            'foto1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Contoh validasi untuk foto1
            'foto2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Contoh validasi untuk foto2
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
            'foto1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Contoh validasi untuk foto1
            'foto2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Contoh validasi untuk foto2
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

        // Simpan data check-in ke dalam database
        Activity::create([
            'id_user' => auth()->user()->id,
            'rencana_aktifitas' => $request->input('deskripsi'),
            'created_at' => now(),
            // Tambahkan kolom-kolom lain yang sesuai dengan kebutuhan Anda
        ]);

        // Redirect kembali ke halaman check-in dengan pesan sukses
        return redirect()->route('checkin.index')->with('success', 'Check-in berhasil.');
    }
}
