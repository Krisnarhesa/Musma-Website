<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;

class DashboardController extends Controller
{
    public function index()
    {
        $data['smft'] = DB::table('calons')
            ->select(DB::raw('count(suaras.id) as voted, calons.nama_panggilan'))
            ->leftJoin('suaras', 'calons.id', '=', 'suaras.calon_id')
            ->where('calons.jenis_calon', '=', 'SMFT')
            ->groupBy('calons.nama_panggilan')
            ->orderBy('voted', 'desc')
            ->get();

        $data['bpmft'] = DB::table('calons')
            ->select(DB::raw('count(suaras.id) as voted, calons.nama_panggilan'))
            ->leftJoin('suaras', 'calons.id', '=', 'suaras.calon_id')
            ->where('calons.jenis_calon', '=', 'BPMFT')
            ->groupBy('calons.nama_panggilan')
            ->orderBy('voted', 'desc')
            ->get();

        $data['jml_milih'] = Mahasiswa::where('status', 'voted')->get()->count();
        $data['jml_golput'] = Mahasiswa::where('status', 'terverifikasi')->get()->count();

        // dd($data);

        return view('admin/index', ['data' => $data]);
    }
}
