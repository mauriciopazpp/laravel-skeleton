<?php

use App\Model\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
                      'id' => '1',
                      'name'  => 'Mauricio Paz',
                      'email' => 'email@gmail.com',
                      'password' => bcrypt('mauricio'),
                      'picture' => 'name.png'
                      ]);

        //factory(App\User::class, 50)->create();
    }
}
