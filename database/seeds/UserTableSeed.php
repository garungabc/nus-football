<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collection = User::get(['id']);
        $reset_user = User::destroy($collection->toArray());

        $users = [
            [
                "name"  => "Hiến NV",
                "index" => 1.9,
            ],
            [
                "name"  => "Thạch BK",
                "index" => 1.9,
            ],
            [
                "name"  => "Tuấn NĐ",
                "index" => 1.9,
            ],
            [
                "name"  => "Hùng PN",
                "index" => 2.1,
            ],
            // [
            //     "name"  => "Vinh P",
            //     "index" => 2,
            // ],
            [
                "name"  => "Chiến TX",
                "index" => 2.2,
            ],
            [
                "name"  => "Tín NQ",
                "index" => 1.9,
            ],
            [
                "name"  => "Phú TV",
                "index" => 1.8,
            ],
            // [
            //     "name"  => "Thịnh CT",
            //     "index" => 1.8,
            // ],
            [
                "name"  => "Thiệu NV",
                "index" => 1.9,
            ],
            [
                "name"  => "Toàn DT",
                "index" => 2,
            ],
            [
                "name"  => "Dậu ĐQ",
                "index" => 2,
            ],
            [
                "name"  => "Khánh NN",
                "index" => 1.6,
            ],
            [
                "name"  => "Thiện TM",
                "index" => 1.7,
            ],
            [
                "name"  => "Hà SV",
                "index" => 1.9,
            ],
            [
                "name"  => "Thịnh PVĐ",
                "index" => 1.7,
            ],
            [
                "name"  => "Kiệt NVT (Kiệt A)",
                "index" => 1.7,
            ],
            [
                "name"  => "Kiệt NHT (Kiệt B)",
                "index" => 2,
            ],
            [
                "name"  => "Linh BT",
                "index" => 1.9,
            ],
            [
                "name"  => "Sâm HT",
                "index" => 1.5,
            ],
            [
                "name"  => "Nguyên MV",
                "index" => 1.8,
            ],
            [
                "name"  => "Cường PM",
                "index" => 2.1,
            ],
            [
                "name"  => "Sang LT",
                "index" => 1.8,
            ],
            [
                "name"  => "Lễ NH",
                "index" => 1.6,
            ],
            [
                "name"  => "Phong TH",
                "index" => 1.5,
            ],
            [
                "name"  => "Sang NV",
                "index" => 1.5,
            ],
            [
                "name"  => "Tâm LH",
                "index" => 1.6,
            ],
        ];


        foreach ($users as $key => $user) {

            $exist_user = User::where('name', $user['name'])->first();
            if (isset($exist_user->id)) {
                $exist_user->delete();
            }
            $adduser        = new User;
            $adduser->name  = $user['name'];
            $adduser->index = $user['index'];
            $adduser->save();
        }
    }
}
