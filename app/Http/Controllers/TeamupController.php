<?php

namespace App\Http\Controllers;

use App\History;
use App\User;
use Carbon\Carbon;
use Screen\Capture;
use Illuminate\Support\Str;
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

        return view('components.team.prepareteam', ['users' => $users]);
    }

    /**
     * [arrangeTeamWeeks main]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function arrangeTeamWeeks(Request $request)
    {
        $users_query = new User();
        if ($request->has('u-off')) {
            $uoff_ids    = $request->get('u-off');
            $users_query = $users_query->whereNotIn('id', $uoff_ids);
        } else {
            $uoff_ids = [];
        }
        $users      = $users_query->where('slug', '!=', 'hien-nv')->orderBy('index', 'desc')->get();
        $count_user = $users_query->count();

        $team       = [];
        $team_level = [];
        $team_nums  = 4;


        if ($count_user < 19) {
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

            // second time
            $this->afterProcess($team_level, $team);
        }

        // handle case: Hien-NV
        $count_user += $this->handleExceptionTeam($team, $uoff_ids);
        $sum_user = User::count();

        if ($count_user > $sum_user) {
            $count_user = $sum_user;
        }

        $max_row = floor($count_user / $team_nums) + (($count_user % $team_nums) >= 1 ? 1 : 0);

        $image = '';
        // $image = $this->captureMonitor($request->fullUrl());
        return view('components.team.showteam', ['team' => $team, 'sum' => $count_user, 'max_row' => $max_row, 'image' => $image]);
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

    /**
     * [afterProcess handle team_level array left]
     * @param  [type] &$team_level [description]
     * @param  [type] &$team       [description]
     * @return [type]              [description]
     */
    public function afterProcess(&$team_level, &$team)
    {
        $point_team = $this->countSumPointEachTeam($team);

        $tmp_team_level = $team_level;
        foreach ($tmp_team_level as $key => $team_item) {
            if (!empty($team_item)) {
                foreach ($point_team as $key_team => $point) {
                    if (!empty($team_level[$key])) {
                        $sub_item     = array_rand($team_level[$key]);
                        array_push($team[$key_team], $team_item[$sub_item]);
                        unset($team_level[$key][$sub_item]);
                    }
                }
            }
        }

        //====== check last time =====
        $min_team = [
            'count' => count($team[1]),
            'level' => 1
        ];

        foreach ($team as $key_team => $item) {
            if ($min_team['count'] > count($item)) {
                $min_team = [
                    'count' => count($item),
                    'level' => $key_team
                ];
            }
        }

        // max
        $max_team = [
            'count' => count($team[1]),
            'level' => 1
        ];

        foreach ($team as $key_team => $item) {
            if ($max_team['count'] < count($item)) {
                $max_team = [
                    'count' => count($item),
                    'level' => $key_team
                ];
            }
        }

        // if max > min 2 user, move 1 user from max to min
        if ($max_team['count'] - $min_team['count'] >= 2) {
            $tmp_user_team = [];
            foreach ($team[$max_team['level']] as $key => $user) {
                if ($user['index'] >= 1.6 && $user['index'] <= 1.9) {
                    $tmp_user_team[$key] = $user;
                }
            }
            for ($i=0; $i <= $max_team['count'] - $min_team['count'] - 2; $i++) {
                $sub_item     = array_rand($tmp_user_team);
                array_push($team[$min_team['level']], $team[$max_team['level']][$sub_item]);
                unset($team[$max_team['level']][$sub_item]);
                unset($tmp_user_team[$sub_item]);
            }
        }
    }

    /**
     * [handleExceptionTeam handle case Hien-NV belongs a team have many people]
     * @param  [type] &$team    [description]
     * @param  [array] $uoff_ids [description]
     * @return [type]           [description]
     */
    public function handleExceptionTeam(&$team, $uoff_ids = [])
    {
        $point_team = $this->countSumPointEachTeam($team);
        $user_except = User::where('slug', 'hien-nv')->first();

        if (!in_array($user_except->id, $uoff_ids)) {
            foreach ($point_team as $key => $point) {
                array_push($team[$key], $user_except);
                break;
            }
            return 1;
        }
        return 0;
    }

    /**
     * [countSumPointEachTeam sort team by sum all index and order index ASC]
     * @param  [type] $team [description]
     * @return [type]       [description]
     */
    public function countSumPointEachTeam($team)
    {
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

    public function captureMonitor($url)
    {
        $screen_shot_json_data = file_get_contents("https://www.googleapis.com/pagespeedonline/v2/runPagespeed?url=$url&screenshot=true");
        $screen_shot_result = json_decode($screen_shot_json_data, true);
        $screen_shot = $screen_shot_result['screenshot']['data'];
        $screen_shot = str_replace(array('_','-'), array('/', '+'), $screen_shot);
        $screen_shot_image = "<img src=\"data:image/jpeg;base64,".$screen_shot."\" class='img-responsive'/>";
        return $screen_shot_image;
    }

    public function saveTeam(Request $request)
    {
        $inputs = $request->except('_token', 'max_row', 'sum', 'come_late', 'leave_early');
        $max_row = $request->get('max_row');
        $sum = $request->get('sum');
        $leave_early = !empty($request->get('leave_early')) ? json_encode($request->get('leave_early')) : '';
        $come_late = !empty($request->get('come_late')) ? json_encode($request->get('come_late')) : '';

        if (!empty($inputs)) {
            $data_team = [];
            foreach ($inputs as $key_team => $item) {
                foreach ($item as $sub_key => $value) {
                    $data_team[$key_team][] = $value;
                }
            }

            if (!empty($data_team)) {
                $history = History::whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->delete();

                $history = new History();
                foreach ($data_team as $key_team => $team) {
                    switch ($key_team) {
                        case 'team_1':
                            $history->team_1 = json_encode($team);
                            break;
                        case 'team_2':
                            $history->team_2 = json_encode($team);
                            break;
                        case 'team_3':
                            $history->team_3 = json_encode($team);
                            break;
                        case 'team_4':
                            $history->team_4 = json_encode($team);
                            break;
                        default:
                            # code...
                            break;
                    }
                }
                $history->leave_early = $leave_early;
                $history->come_late = $come_late;
                $history->max_row = $max_row;
                $history->sum = $sum;
                $history->save();
            }
        }
        return redirect()->route('history.index');
    }
}
