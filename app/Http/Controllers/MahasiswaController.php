<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Role_model;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    public function index()
    {
        return view('admin/mahasiswa/index');
    }

    public function data()
    {
        $mahasiswa = Mahasiswa::orderByRaw('FIELD(status, "terdaftar")DESC')->orderBy('id', 'DESC')->get();
        $no = 1;
        foreach ($mahasiswa as $item) {
            $output = '<tr>
             <td>' . $no++ . '</td>
             <td>' . $item->user->name . '</td>
             <td>' . $item->user->nim . '</td>';

            if ($item->status == 'terverifikasi' || $item->status == 'voted') {
                $output .= '<td> <div class="text-center"><i class="fa fa-check"></i></div></td>';
            } else {
                $output .= '<td> <a href=' . $item->takeimage . ' data-fancybox="gallery" data-caption=' . $item->name . ' ><img src=' . $item->takeimage . ' alt="avatar" style="max-width: 100px"></a></td>';
            }

            $output .= '<td>' . $item->status . '</td>
             <td>' . $item->created_at . '</td>';

            if ($item->status == 'terverifikasi' || $item->status == 'voted') {
                $output .= '<td> <div class=" text-center"><i class="fa fa-check"></i></div></td>';
            } else {
                $output .= '<td>
                <div class=" text-center"><button class="btn-verif btn btn-primary" type="button" data-id=' . $item->id . '>Verif</button>
                <button class="btn-delete btn btn-danger" type="button" data-id=' . $item->id . '>Hapus</button></div>
                </td>';
            };
            echo $output;
        };
    }

    public function verif(Request $request, Mahasiswa $mahasiswa)
    {
        $mahasiswa->status = 'terverifikasi';
        $mahasiswa->verified_at = date('Y-m-d');
        $mahasiswa->update();
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $user = User::find($mahasiswa->user_id);
        $role = Role_model::find($mahasiswa->user_id);
        // dd($role);
        $user->password = null;
        $user->save();
        Storage::delete($mahasiswa->file_url);
        $mahasiswa->delete();
        $role->delete();
    }
}
