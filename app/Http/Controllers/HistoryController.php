<?php

namespace App\Http\Controllers;

use App\History;
use App\User;
use Carbon\Carbon;
use Screen\Capture;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class HistoryController extends Controller
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
        $histories = [];
        $histories_raw = History::orderBy('id', 'desc')->limit(4)->get();

        if (!empty($histories_raw)) {
            foreach ($histories_raw as $key => $item) {
                $histories[$key] = [
                    'max_row' => $item->max_row,
                    'sum' => $item->sum,
                    'date' => Carbon::parse($item->created_at)->format('Y-m-d'),
                    'daysofweek' => Carbon::parse($item->created_at)->isoFormat('dddd'),
                ];
                for ($i = 1; $i <= 4; $i++) {
                    $team = 'team_' . $i;
                    if (isset($item->{$team})) {
                        $user_ids = json_decode($item->{$team}, true);
                        $users = User::whereIn('id', $user_ids)->get()->pluck('name')->toArray();
                        $histories[$key]['team'][$team] = $users;
                    }
                }
            }
        }

        return view('history.index', ['histories' => $histories]);
    }
}
