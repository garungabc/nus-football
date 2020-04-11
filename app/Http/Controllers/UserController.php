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

    public function create()
    {
        return view('user.create');
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
        // dd($histories);
        return redirect()->route('user.create');
    }
}
