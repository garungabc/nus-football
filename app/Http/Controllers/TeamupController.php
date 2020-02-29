<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class TeamupController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function prepareTeam()
    {
        $users = User::select('id', 'name', 'index')->orderBy('index', 'desc')->get();
        return view('prepareteam', ['users' => $users]);
    }

    public function arrangeTeamWeeks(Request $request)
    {
        $users_query = new User();
        if ($request->has('u-off')) {
            $uoff_ids    = $request->get('u-off');
            $users_query = $users_query->whereNotIn('id', $uoff_ids);
        }
        $users      = $users_query->where('slug', '!=', 'hien-nv')->orderBy('index', 'desc')->get();
        $count_user = $users_query->count();

        $team       = [];
        $team_level = [];
        $team_nums  = 4;

        if ($count_user / 4 < 5) {
            $team_nums = 3;
        }

        foreach ($users as $key => $user) {
            $user = $user->toArray();

            switch (true) {
                case ($user['index'] >= 2):
                    $team_level[1][] = $user;
                    break;
                case ($user['index'] >= 1.8 && $user['index'] < 2):
                    $team_level[2][] = $user;
                    break;
                case ($user['index'] >= 1.6 && $user['index'] < 1.8):
                    $team_level[3][] = $user;
                    break;
                case ($user['index'] < 1.6):
                    $team_level[4][] = $user;
                    break;

                default:
                    # code...
                    break;
            }
        }

        $tmp_team_level = $team_level;
        foreach ($tmp_team_level as $tmp_key => $tmp_team_item) {
            $this->process($team_level[$tmp_key], $team_nums, $team);
        }

        if (!empty($team_level)) {
            $this->afterProcess($team_level, $team);
        }

        // handle case: Hien-NV
        $count_user += $this->handleExceptionTeam($team, $uoff_ids);

        $max_row = floor($count_user / $team_nums) + (($count_user % $team_nums) >= 1 ? 1 : 0);

        return view('showteam', ['team' => $team, 'sum' => $count_user, 'max_row' => $max_row]);
    }

    public function process(&$team_item, $team_nums, &$team)
    {
        if ($team_item >= $team_nums) {
            $loop_max = floor(count($team_item) / $team_nums);
            for ($loop_number = 0; $loop_number < $loop_max; $loop_number++) {
                for ($num = 1; $num <= $team_nums; $num++) {
                    $sub_item     = array_rand($team_item);
                    $team[$num][] = $team_item[$sub_item];
                    unset($team_item[$sub_item]);
                }
            }
        }
    }

    public function afterProcess(&$team_level, &$team)
    {
        $point_team = $this->countSumPointEachTeam($team);

        $tmp_team_level = $team_level;
        foreach ($tmp_team_level as $key => $team_item) {
            if(!empty($team_item)) {
                foreach ($point_team as $key_team => $point) {
                    if(!empty($team_level[$key])) {
                        $sub_item     = array_rand($team_level[$key]);
                        array_push($team[$key_team], $team_item[$sub_item]);
                        unset($team_level[$key][$sub_item]);
                    }
                }
            }
        }

        // check last time
        // $min_team = [
        //     'count' => count($team[1]),
        //     'level' => 1
        // ];

        // foreach ($team as $key_team => $item) {
        //     if($min_team['count'] - count($item) >= 2) {
        //         $sub_item = array_rand($team_level[$key]);
        //     } else {
        //         $min_team = [
        //             'count' => count($item),
        //             'level' => $key_team
        //         ];
        //     }
        // }
    }

    public function handleExceptionTeam(&$team, $uoff_ids)
    {
        $point_team = $this->countSumPointEachTeam($team);
        $user_except = User::where('slug', 'hien-nv')->first();

        if(!in_array($user_except->id, $uoff_ids)) {
            foreach ($point_team as $key => $point) {
                array_push($team[$key], $user_except);
                break;
            }
            return 1;
        }
        return 0;
    }

    public function countSumPointEachTeam($team) {
        $point_team = [];
        foreach ($team as $key => $item_user) {
            $count_point = 0;
            foreach ($item_user as $user) {
                $count_point += $user['index'];
            }
            $point_team[$key] = $count_point;
        }
        asort($point_team);
        return $point_team;
    }
}
