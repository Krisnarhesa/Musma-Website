<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        $prodi = Prodi::all();
        return view('prodi', ['prodi' => $prodi]);
    }

    public function create()
    {
        return view('prodi_tambah');
    }
}
