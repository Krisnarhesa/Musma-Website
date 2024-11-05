<?php

namespace App\Http\Controllers;

use App\Models\Role_model;
use App\Models\role;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $role = Role::all();
        $mahasiswa = Mahasiswa::select('*', 'users.name AS name')
            ->join('users', 'users.id', '=', 'mahasiswas.user_id')
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'mahasiswas.user_id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')->orderBy('model_has_roles.role_id', 'ASC')->get();
        return view('/admin/role/index', compact('role', 'mahasiswa'));
    }

    public function update(Request $request, Role_model $role_model)
    {
        $role_model->role_id = $request->role_id;
        $role_model->update();
    }
}
