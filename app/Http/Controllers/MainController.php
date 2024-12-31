<?php

namespace App\Http\Controllers;

use App\Models\Calon;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Suara;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class MainController extends Controller
{
    /* public function role()
    {
        Role::create([
            'name' => 'sekre',
            'guard_name' => 'web'
        ]);
    } */

    public function index()
    {
        $id_user = Auth::id();
        $smft = Calon::where('jenis_calon', 'SMFT')->get();
        $bpmft = Calon::where('jenis_calon', 'BPMFT')->get();
        $mahasiswa = Mahasiswa::where('user_id', $id_user)->get()->first();
        if (Auth::user()) {
            $suara = Suara::where('mahasiswa_id', $mahasiswa->id)->get();
            return view('index', ['smft' => $smft, 'bpmft' => $bpmft, 'suara' => $suara, 'mahasiswa' => $mahasiswa]);
        } else {
            return view('index', ['smft' => $smft, 'bpmft' => $bpmft]);
        }
    }

    public function rekapitulasi()
    {
        $id_user = Auth::id();
        $smft = Calon::where('jenis_calon', 'SMFT')->get();
        $bpmft = Calon::where('jenis_calon', 'BPMFT')->get();
        $mahasiswa = Mahasiswa::where('user_id', $id_user)->get()->first();

        if (Auth::user()) {
            $suara = Suara::where('mahasiswa_id', $mahasiswa->id)->get();
            return view('rekap', ['smft' => $smft, 'bpmft' => $bpmft, 'suara' => $suara, 'mahasiswa' => $mahasiswa]);
        } else {
            return view('rekap', ['smft' => $smft, 'bpmft' => $bpmft,  'mahasiswa' => $mahasiswa]);
        }
    }

    public function misi(Request $request)
    {
        $calonid = $request->id;
        $visi = Calon::where('id', $calonid)->get();
        foreach ($visi as $item) {
            $output = '
            <div class="feature-box feature-box-style-2">
                <div class="feature-box-icon">
                    <i class="icons icon-list "></i>
                </div>
                <div class="feature-box-info">
                    <h4 class="font-weight-bold  text-4 mb-2">VISI</h4>
                    <div id="text-misi" class=" opacity-7 text-justify" >'
                . $item->visi .
                '</div>
                </div>
            </div>
            <div class="feature-box feature-box-style-2">
                <div class="feature-box-icon">
                    <i class="icons icon-plus "></i>
                </div>
                <div class="feature-box-info">
                    <h4 class="font-weight-bold  text-4 mb-2">MISI</h4>
                    <div class=" opacity-7 text-justify" style="margin-left: 1.2em;">'
                . $item->misi .
                '</div>
                </div>
            </div>';
            echo ($output);
        }
    }

    public function vote(Request $request)
    {
        // $data = json_decode(file_get_contents(public_path('data/info.json')), true);
        // $voteDate = app()->environment('local') ? date('Y-m-d') : $data['masa_pemilihan']['date'];

        // $voteDate = '2024-01-14';

        // if (!Auth::check()) {
        //     return "Vote gagal, Silahkan Login Dengan Akun Terverifikasi";
        // }

        // if (date('Y-m-d') !== $voteDate) {
        //     return "Vote hanya dapat dilakukan pada tanggal 14 Januari 2024 pukul 06.00 - 24.00";
        // }

        // $voteDate = '2024-01-14';
        $currentDate = now()->format('Y-m-d H:i:s');

        if (!Auth::check()) {
            return "Vote gagal, Silahkan Login Dengan Akun Terverifikasi";
        }

        // if (date('Y-m-d') !== $voteDate) {
        //     // return "Vote Hanya dapat dilakukan pada tanggal 14 Januari 2024";
        //     return "Vote hanya dapat dilakukan pada tanggal 14 Januari 2024 pukul 06.00 - 23.59";
        // }

        if ($currentDate < '2025-01-10 06:00:00' || $currentDate > '2025-01-10 23:59:59') {
            return "Vote hanya dapat dilakukan pada tanggal 10 Januari 2025 pukul 06.00 - 23.59";
        }

        $id_user = Auth::id();
        $mahasiswa = Mahasiswa::where('user_id', $id_user)->first();
        $user = User::find($id_user);

        if (!$mahasiswa) {
            return "Vote Gagal, Maaf Anda Belum Terverifikasi";
        }

        if ($mahasiswa->status === 'voted') {
            return "Vote Gagal, Anda Sudah Melakukan Vote";
        }

        if ($mahasiswa->status !== 'terverifikasi') {
            return "Vote Gagal, Maaf Anda Belum Terverifikasi";
        }

        if (!isset($request->smft) || !isset($request->bpmft)) {
            return "Silahkan pilih salah satu calon ketua SMFT dan BPMFT ";
        }

        $mahasiswa->status = 'voted';
        $mahasiswa->update();

        $this->saveVote($mahasiswa->id, $request->smft);
        $this->saveVote($mahasiswa->id, $request->bpmft);

        return "Vote Disimpan, Terima kasih telah memilih";
    }

    private function saveVote($mahasiswaId, $calonId)
    {
        $suara = new Suara();
        $suara->mahasiswa_id = $mahasiswaId;
        $suara->calon_id = $calonId;
        $suara->save();
    }

    public function chart()
    {
        foreach (Calon::where('jenis_calon', 'SMFT')->cursor() as $calon_smft) {
            $prodis = [];
            $prodisValues = [];
            foreach (Prodi::cursor() as $prodi) {

                $jumlah = DB::table('suaras')
                    ->join('mahasiswas', 'suaras.mahasiswa_id', '=', 'mahasiswas.id')
                    ->join('users', 'mahasiswas.user_id', '=', 'users.id')
                    ->where('suaras.calon_id', '=', $calon_smft->id)
                    ->where('users.prodi_id', '=', $prodi->id)
                    ->get()->count();

                array_push($prodis, $prodi->nama_prodi);
                array_push($prodisValues, $jumlah);
            }
            $rekap['SMFT'][$calon_smft->nama_panggilan]['prodis'] = $prodis;
            $rekap['SMFT'][$calon_smft->nama_panggilan]['prodi_value'] = $prodisValues;
        }

        foreach (Calon::where('jenis_calon', 'BPMFT')->cursor() as $calon_bpmft) {
            $prodis = [];
            $prodisValues = [];
            foreach (Prodi::cursor() as $prodi) {
                $jumlah = DB::table('suaras')
                    ->join('mahasiswas', 'suaras.mahasiswa_id', '=', 'mahasiswas.id')
                    ->join('users', 'mahasiswas.user_id', '=', 'users.id')
                    ->where('suaras.calon_id', '=', $calon_bpmft->id)
                    ->where('users.prodi_id', '=', $prodi->id)
                    ->get()->count();

                array_push($prodis, $prodi->nama_prodi);
                array_push($prodisValues, $jumlah);
            }
            $rekap['BPMFT'][$calon_bpmft->nama_panggilan]['prodis'] = $prodis;
            $rekap['BPMFT'][$calon_bpmft->nama_panggilan]['prodi_value'] = $prodisValues;
        }

        return json_encode($rekap);
    }

    public function rekap()
    {

        foreach (Prodi::cursor() as $prodi) {
            $calonNames = [];
            $calonVotes = [];

            foreach (Calon::where('jenis_calon', 'BPMFT')->cursor() as $calon_bpmft) {
                $jumlah = DB::table('suaras')
                    ->join('mahasiswas', 'suaras.mahasiswa_id', '=', 'mahasiswas.id')
                    ->join('users', 'mahasiswas.user_id', '=', 'users.id')
                    ->where('users.prodi_id', '=', $prodi->id)
                    ->where('suaras.calon_id', '=', $calon_bpmft->id)
                    ->get()->count();

                array_push($calonNames, $calon_bpmft->nama_panggilan);
                array_push($calonVotes, $jumlah);
            }
            $rekap['BPMFT'][$prodi->nama_prodi]['calon_names'] = $calonNames;
            $rekap['BPMFT'][$prodi->nama_prodi]['calon_votes'] = $calonVotes;

            $calonNames = [];
            $calonVotes = [];
            foreach (Calon::where('jenis_calon', 'SMFT')->cursor() as $calon_smft) {
                $jumlah = DB::table('suaras')
                    ->join('mahasiswas', 'suaras.mahasiswa_id', '=', 'mahasiswas.id')
                    ->join('users', 'mahasiswas.user_id', '=', 'users.id')
                    ->where('users.prodi_id', '=', $prodi->id)
                    ->where('suaras.calon_id', '=', $calon_smft->id)
                    ->get()->count();

                array_push($calonNames, $calon_smft->nama_panggilan);
                array_push($calonVotes, $jumlah);
            }
            $rekap['SMFT'][$prodi->nama_prodi]['calon_names'] = $calonNames;
            $rekap['SMFT'][$prodi->nama_prodi]['calon_votes'] = $calonVotes;
        }

        // $id_user = Auth::id();
        // $smft = Calon::where('jenis_calon', 'SMFT')->get();
        // $bpmft = Calon::where('jenis_calon', 'BPMFT')->get();
        // $mahasiswa = Mahasiswa::where('user_id', $id_user)->get()->first();

        //$suara = Suara::where('mahasiswa_id', $mahasiswa->id)->get();
        return view('rekap', compact(['rekap']));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
