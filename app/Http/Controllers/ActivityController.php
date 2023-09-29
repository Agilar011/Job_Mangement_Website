<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::all();
        return view('activities.index', compact('activities'));
    }

    public function create()
    {
        return view('activities.create');
    }

    public function store(Request $request)
    {
        $activity = Activity::create($request->all());

        if ($request->hasFile('foto1')) {
            $activity->foto1 = $request->file('foto1')->store('foto1');
        }

        if ($request->hasFile('foto2')) {
            $activity->foto2 = $request->file('foto2')->store('foto2');
        }

        $activity->save();

        return redirect()->route('activities.index')->with('success', 'Aktivitas berhasil disimpan.');
    }

    public function show(Activity $activity)
    {
        return view('activities.show', compact('activity'));
    }

    public function edit(Activity $activity)
    {
        return view('activities.edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $activity->update($request->all());

        if ($request->hasFile('foto1')) {
            $activity->foto1 = $request->file('foto1')->store('foto1');
        }

        if ($request->hasFile('foto2')) {
            $activity->foto2 = $request->file('foto2')->store('foto2');
        }

        $activity->save();

        return redirect()->route('activities.index')->with('success', 'Aktivitas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $activity = Activity::find($id);
        $activity->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus.');
    }

    public function checkIn(Request $request)
    {
        $inputText = $request->input('deskripsi');
        $inputTime = $request->jamCheckIn;
        $lines = explode(PHP_EOL, $inputText);
        $lines = array_map('trim', $lines);
        $formattedText = implode(PHP_EOL, $lines);

        Activity::create([
            'id_user' => auth()->user()->id,
            'nama' => auth()->user()->name,
            'rencana_aktifitas' => $formattedText,
            'created_at' => $inputTime,
        ]);
        $activity = Activity::where('id_user', auth()->user()->id)->whereDate('created_at', today())->firstOrFail();
        $activity->updated_at = null;
        $activity->save();
        return redirect()->back();
    }

    public function checkOut(Request $request)
    {
        if ($request->hasFile('foto1')) {
            $foto1Path = $request->file('foto1')->store('public/checkout_photos');
        }

        if ($request->hasFile('foto2')) {
            $foto2Path = $request->file('foto2')->store('public/checkout_photos');
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
            $checkInToday->foto1 = $request->file('foto1')->store('checkout_photos');
        }

        if ($request->hasFile('foto2')) {
            $checkInToday->foto2 = $request->file('foto2')->store('checkout_photos');
        }

        $checkInToday->save();

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
}



