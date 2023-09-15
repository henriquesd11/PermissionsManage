<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public function index()
    {
        $permissionsList = Permission::get();

        return response()->json(['list' => $permissionsList]);
    }
}
