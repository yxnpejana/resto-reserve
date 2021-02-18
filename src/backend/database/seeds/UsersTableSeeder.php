<?php

use App\Models\User;
use App\Models\UserStatus;
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
        // retrieve user status
        $status = UserStatus::where('name', config('user.statuses.active'))->first();

        // create the system admin
        $this->_createSystemAdmin();

        if (env('APP_ENV') === 'local') {
            factory(User::class, 50)->create([
                'user_status_id' => $status->id,
            ]);
        }
    }

    private function _createSystemAdmin()
    {
        // retrieve user status
        $status = UserStatus::where('name', config('user.statuses.active'))->first();

        // create the system admin
        User::create([
            'first_name' => 'Sprobe',
            'last_name' => 'Administrator',
            'email' => 'admin@tcg.sprobe.ph',
            'password' => Hash::make('Password2020!'),
            'user_status_id' => $status->id,
        ]);
    }
}
