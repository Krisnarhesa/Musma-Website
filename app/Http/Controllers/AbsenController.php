<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Suara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class AbsenController extends Controller
{
    public function index()
    {
        $absen = DB::table('mahasiswas')
            ->select('*','mahasiswas.id as mahasiswa_id')
            ->where('status', 'voted')
            ->join('users', 'mahasiswas.user_id', '=', 'users.id')
            ->join('prodis', 'users.prodi_id', '=', 'prodis.id')
            ->orderBy('users.nim', 'asc')
            ->get();

        // dd($absen);
        return view('admin/absen/index', compact('absen'));
    }

    public function destroy($id)
    {
        if (Auth::user()->hasRole('admin')) {
            Suara::where('mahasiswa_id', $id)->delete();

            $mahasiswa = Mahasiswa::find($id);
            // dd($id);
            $mahasiswa->status = 'terverifikasi';
            $mahasiswa->update();
            return redirect('admin/absen');
        }
    }
}
