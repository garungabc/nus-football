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
        $users = User::get();
        return view('components.users.index', ['users' => $users]);
    }

    public function create()
    {
        return view('components.users.create');
    }

    public function store(Request $request)
    {
        $user_slug = Str::slug($request->get('name'));
        $find_user = User::where('slug', $user_slug)->first();

        if (!isset($find_user->id)) {
            $user = new User;
            $user->name = $request->get('name');
            $user->slug = $user_slug;
            $user->index = $request->get('index');
            $user->save();
        }

        return redirect()->route('user.create');
    }

    public function delete(Request $request)
    {
        $sum = User::count();
        $limit = 6;
        $loop = $sum / $limit;
        $columns = [];

        for ($i=0; $i <= $loop; $i++) {
            $users = User::select('id', 'name', 'index')->limit($limit)->offset($limit *$i)->orderBy('index', 'desc')->get();
            $columns[] = $users;
        }

        return view('user.delete', ['columns' => $columns]);
    }

    public function destroy(Request $request)
    {
        $users_query = new User();
        if ($request->has('u-off')) {
            $uoff_ids    = $request->get('u-off');
            $users_query = $users_query->whereIn('id', $uoff_ids)->delete();
        }

        return redirect()->route('user.delete');
    }
}
