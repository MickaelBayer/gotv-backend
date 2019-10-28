<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getAllRoles()
    {
        $role = Role::get();
        return $role;
    }

    public function getRoleById(int $id)
    {
        $role = Role::find($id);
        return $role;
    }

    public function postRole(Request $request)
    {
        // validation des champs
        try {
            $this->validate($request, [
                'roe_name' => 'required',
                'roe_description' => 'required',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => '3000', 'message' => $e], 500);
        }

        $role = new Role();
        $role->roe_name = $request->roe_name;
        $role->roe_description = $request->roe_description;
        $role->save();
        return $role;
    }

    public function putRoleById(Request $request, int $id)
    {
        // validation des champs
        try {
            $this->validate($request, [
                'roe_name' => 'required',
                'roe_description' => 'required',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => '3000', 'message' => $e], 401);
        }

        $role = Role::find($id);
        $role->roe_name = $request->roe_name;
        $role->roe_description = $request->roe_description;
        $role->save();
        return $role;
    }

    public function deleteRoleById(int $id)
    {
        $role = Role::find($id);
        $role->delete();
        return response()->json(['message' => 'Deleted !']);
    }
}
