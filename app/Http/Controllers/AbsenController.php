<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Suara;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class AbsenController extends Controller
{
    public function index()
    {
        // $absen = DB::table('mahasiswas')
        //     ->select('*','mahasiswas.id as mahasiswa_id')
        //     ->where('status', 'voted')
        //     ->join('users', 'mahasiswas.user_id', '=', 'users.id')
        //     ->join('prodis', 'users.prodi_id', '=', 'prodis.id')
        //     ->orderBy('users.nim', 'asc')
        //     ->get();

        $absen = DB::table('mahasiswas')
            ->select('*', 'mahasiswas.id as mahasiswa_id', 'suaras.created_at as waktu_memilih')
            ->where('status', 'voted')
            ->join('users', 'mahasiswas.user_id', '=', 'users.id')
            ->join('prodis', 'users.prodi_id', '=', 'prodis.id')
            ->join('suaras', 'mahasiswas.id', '=', 'suaras.mahasiswa_id')
            ->orderBy('users.nim', 'asc')
            ->get();
            
        $groupedAbsen = $absen->groupBy('mahasiswa_id');

        $processedAbsen = $groupedAbsen->map(function ($group) {
            return $group->reduce(function ($carry, $item) {
                if ($item->calon_id >= 1 && $item->calon_id <= 2) {
                    $carry['smft'] = $item->calon_id;
                } elseif ($item->calon_id >= 3 && $item->calon_id <= 5) {
                    $carry['bpmft'] = $item->calon_id;
                }
                $carry['mahasiswa_id'] = $item->mahasiswa_id;
                $carry['nim'] = $item->nim;
                $carry['name'] = $item->name;
                $carry['nama_prodi'] = $item->nama_prodi;
                $carry['status'] = $item->status;
                $carry['created_at'] = $item->created_at;
                $carry['updated_at'] = $item->updated_at;
                $carry['waktu_memilih'] = $item->waktu_memilih;
                return $carry;
            }, []);
        });

        $absen = $processedAbsen->values()->all();

        // dd($absen);
        return view('admin/absen/index', compact('absen'));
    }

    public function destroy($id)
    {
        if (Auth::user()->hasRole('admin')) {
            Suara::where('mahasiswa_id', $id)->delete();

            $mahasiswa = Mahasiswa::find($id);
            $user = User::find($mahasiswa->user_id);
            // dd($id);
            $mahasiswa->status = 'terverifikasi';
            $mahasiswa->update();
            
            // MainController::infoLog("RESET {$user->nim} - {$user->name}} BY " . Auth::user()->name);

            return redirect('admin/absen');
        }
    }
}
