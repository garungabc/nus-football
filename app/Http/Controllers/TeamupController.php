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

    public function prepareTeam() {
        $users = User::select('id', 'name', 'index')->orderBy('index', 'desc')->get();
        return view('prepareteam', ['users' => $users]);
    }

    public function arrangeTeamWeeks(Request $request) {
        $uoff_ids = $request->get('u-off');
        $users = User::select('id', 'name', 'index')->whereNotIn('id', $uoff_ids)->orderBy('index', 'desc')->get();

        $team = [];
        $team_level = [];

        foreach ($users as $key => $user) {
            $user = $user->toArray();
            switch (true) {
                case ($user['index'] >= 2.5):
                    $team_level[1][] = $user; 
                    break;
                case ($user['index'] >= 2 && $user['index'] < 2.5):
                    $team_level[2][] = $user;
                    break;
                case ($user['index'] >= 1.5 && $user['index'] < 2):
                    $team_level[3][] = $user;
                    break;
                case ($user['index'] < 1.5):
                    $team_level[4][] = $user;
                    break;
                
                default:
                    # code...
                    break;
            }
        }

        $team_nums = 4;
        $count_user = count($users);
        if($count_user/4 < 5) {
            $team_nums = 3;
        }

        if(!empty($team_level[1])) {
            while(!empty($team_level[1])) {
                for ($i = 1; $i <= $team_nums; $i++) { 
                    if(isset($team_level[1]) && !empty($team_level[1])) {
                        $sub_item = array_rand($team_level[1]);
                        $team[$i][] = $team_level[1][$sub_item];
                        unset($team_level[1][$sub_item]);
                    }
                }
            }
        }

        if(!empty($team_level[2])) {
            while(!empty($team_level[2])) {
                for ($i = 1; $i <= $team_nums; $i++) { 
                    if(isset($team_level[2]) && !empty($team_level[2])) {
                        $sub_item = array_rand($team_level[2]);
                        $team[$i][] = $team_level[2][$sub_item];
                        unset($team_level[2][$sub_item]);
                    }
                }
            }
        }

        if(!empty($team_level[3])) {
            while(!empty($team_level[3])) {
                for ($i = 1; $i <= $team_nums; $i++) { 
                    if(isset($team_level[3]) && !empty($team_level[3])) {
                        $sub_item = array_rand($team_level[3]);
                        $team[$i][] = $team_level[3][$sub_item];
                        unset($team_level[3][$sub_item]);
                    }
                }
            }
        }

        if(!empty($team_level[4])) {
            while(!empty($team_level[4])) {
                for ($i = 1; $i <= $team_nums; $i++) { 
                    if(isset($team_level[4]) && !empty($team_level[4])) {
                        $sub_item = array_rand($team_level[4]);
                        $team[$i][] = $team_level[4][$sub_item];
                        unset($team_level[4][$sub_item]);
                    }
                }
            }
        }


        return view('showteam', ['team' => $team, 'sum' => $count_user]);
    }
}

