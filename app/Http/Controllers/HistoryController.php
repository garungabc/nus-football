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
                    'come_late' => json_decode($item->come_late, true),
                    'leave_early' => json_decode($item->leave_early, true),
                    'max_row' => $item->max_row,
                    'sum' => $item->sum,
                    'date' => Carbon::parse($item->created_at)->format('Y-m-d'),
                    'daysofweek' => Carbon::parse($item->created_at)->isoFormat('dddd'),
                ];
                for ($i = 1; $i <= 4; $i++) {
                    $team = 'team_' . $i;
                    if (isset($item->{$team})) {
                        $users = json_decode($item->{$team}, true);
                        $histories[$key]['team'][$team] = $users;
                    }
                }
            }
        }
        return view('components.history.index', ['histories' => $histories]);
    }
}
