<?php

namespace App\Http\Controllers;

use App\Models\Suara;
use Illuminate\Http\Request;

class SuaraController extends Controller
{
    public function index()
    {
        $suara = Suara::all();
        return view('suara', ['suara' => $suara]);
    }

    public function update(Request $request, Suara $suara)
    {
        $this->validate($request, [
            'calon' => 'required',
        ]);

        $suara->calon_id = $request->calon;
        $suara->save();
    }

    public function destroy(Suara $suara)
    {
        $suara->delete();
        return redirect('/suara');
    }
}
