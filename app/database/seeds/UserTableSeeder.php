<?php

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $user = new User;
        $user->email = 'kacper.lukawski@uj.edu.pl';
        $user->password = 'qwerty';
        $user->save();
    }

}
