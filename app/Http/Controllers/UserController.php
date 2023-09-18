<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

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

    public function create()
    {
        return view('frontend.user.create');
    }

    public function store(Request $request): JsonResponse
    {
        $this->validate($request, [
           'email' => 'required|email|max:255|unique:users',
           'name' => 'required|string|max:255',
           'password' => 'required|min:8',
        ]);

        $user = User::create(
            [
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password'))
            ]
        );

        $user->assignRole('comum');

        return response()->json(
            [
                'message' => 'Usuário com sucesso!',
                ResponseAlias::HTTP_CREATED
            ]
        );
    }

    public function delete(int $userId)
    {
        $user = User::find($userId);
        $user->delete();
    }

    public function getListUsers(): JsonResponse
    {
        $list = User::dontShowAdmin()
            ->with('permissions')
            ->orderBy('created_at','desc')
            ->get();

        return response()->json([
            'list' => $list->toArray(),
        ], Response::HTTP_OK);
    }

    public function update(Request $request, int $id)
    {
        $this->validate($request, [
           'email' => 'required|email',
           'name' => 'required|string',
        ]);

        User::whereId($id)->update($request->only(['email', 'name']));

        return response()->json(
            [
                'message' => "Usuário atualizado",
            ],
            Response::HTTP_ACCEPTED
        );
    }

    public function removePermission(int $userId, string $permission): JsonResponse
    {
        $user = User::find($userId);
        $user->revokePermissionTo($permission);

        return response()->json([], Response::HTTP_OK);
    }

    public function addPermission(int $userId, string $permission)
    {
        $user = User::find($userId);
        $user->givePermissionTo($permission);

        return response()->json([], Response::HTTP_OK);
    }
}
