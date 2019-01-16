<?php
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $admin=User::create([
            'name' => 'ibraam',
            'email' => 'ibraamemad@gmail.com',
            'password' => bcrypt('1907mx1997'),
            'address' => 'El tagamoo3',
            'role'=>'systemAdmin'
            ]);
        
    }
}