<?php

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
        //pre defined
        $roles = [['name' => 'Administrator'], ['name' => 'Subscriber'], ['name' => 'Author']];
        foreach ($roles as $role) {
            App\Role::updateOrCreate($role);
        }
        $categories = [['name' => 'PHP'], ['name' => 'Javascript'], ['name' => 'Python']];
        foreach ($categories as $category) {
            App\Category::updateOrCreate($category);
        }
        
        // user and post
        factory('App\User', 10)->create()->each(function($user){

            $user->posts()->save(factory('App\Post')->make());
        });
    }
}
