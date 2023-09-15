<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('role:admin',
            [
                'only' => [
                    'index',
                    'getListUsers',
                    'edit',
                    'update'
                ]
            ]
        );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend.user.home');
    }

    public function edit(int $userId)
    {
        $user = User::with('permissions')->find($userId);
        return view('frontend.user.edit', compact('user'));
    }

    public function getListUsers(): JsonResponse
    {
        $list = User::with('permissions')
            ->orderBy('created_at','desc')
            ->get();

        return response()->json([
            'list' => $list->toArray(),
        ], Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success','User updated successfully');
    }
}
