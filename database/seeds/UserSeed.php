<?php

use Illuminate\Database\Seeder;
use App\Room;
use App\Category;
use App\User;
use App\Customer;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Admin', 'email' => 'admin@admin.com', 'password' => '$2y$10$akHCvTRpvma2eB8VOqUEoOtpWEelS2/e2TZK3LJyfLxuvw8MrQxVq', 'role_id' => 1, 'remember_token' => '',],

        ];

        foreach ($items as $item) {
            User::create($item);
        }

        Category::create([ 'name'=>"small" ]);
        Category::create([ 'name'=>"medium" ]);
        Category::create([ 'name'=>"large" ]);

        Room::create([
            'room_number'=> "24A",
            'floor'=>1,
            'description'=>"good room",
            'status'=>'available'
        ]);

        Customer::create([
           'first_name'=>"Shobhit",
           'last_name'=>"Kansal",
           'email'=>"shobhitk8055@gmail.com",
        ]);
    }
}
