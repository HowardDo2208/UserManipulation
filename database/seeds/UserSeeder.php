<?php

use Illuminate\Database\Seeder;
use App\Town;
use Illuminate\Support\Facades\Cache;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $townsCount = Town::all()->count();
        Cache::put('townsCount', $townsCount,10);
        factory(App\User::class,500)->create();
    }
}
