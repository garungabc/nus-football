<?php

namespace App\Http\Controllers;

use App\History;
use App\User;
use Carbon\Carbon;
use Screen\Capture;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function index()
    {
        $users = User::withTrashed()->get();
        return view('components.users.index', ['users' => $users]);
    }

    public function create()
    {
        return view('components.users.create');
    }

    public function show(Request $request, $id)
    {
        $user = User::find($id);
        return view('components.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!isset($user->id)) {
            $user = new User;
        }

        $user_slug = Str::slug($request->get('name'));

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->slug = $user_slug;
        $user->index = (float) $request->get('index');
        $user->status = (int) $request->get('status');
        $user->save();

        return view('components.users.edit', compact('user'));
    }

    public function store(Request $request)
    {
        $user_slug = Str::slug($request->get('name'));
        $user = User::where('slug', $user_slug)->first();

        if (!isset($user->id)) {
            $user = new User;
        }

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->slug = $user_slug;
        $user->index = (float) $request->get('index');
        $user->status = (int) $request->get('status');
        $user->save();

        return redirect()->route('user.index');
    }

    public function destroy(Request $request)
    {
        $users_query = new User();
        if ($request->has('delete_user_ids')) {
            $uoff_ids    = $request->get('delete_user_ids');
            $users_query = $users_query->whereIn('id', $uoff_ids);
            if ($request->has('force-delete')) {
                $users_query->forceDelete();
            } else {
                $users_query->delete();
            }
        }

        return redirect()->route('user.index');
    }
}
