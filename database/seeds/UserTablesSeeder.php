<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('fa_IR');

        $user = new User();
        $user->name = $faker->firstName;
        $user->family = $faker->lastName;
        $user->mobile = $faker->phoneNumber ;
        $user->username = 'admin';
        $user->password =  bcrypt('123');
        $user->email = 'admin@toca.ir';
        $user->status = 'active';
        $user->save();

    }
}
