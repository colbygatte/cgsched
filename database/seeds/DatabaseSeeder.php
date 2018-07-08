<?php

use App\Announcement;
use App\Day;
use App\Definition;
use App\Shift;
use App\Store;
use App\User;
use App\UserRequest;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Console\Output\ConsoleOutput;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncate()
            ->users()
            ->schedules()
            ->announcements()
            ->passport();
    }

    protected function schedules()
    {
        $user = User::first();

        $user->stores()->attach(
            create(Store::class, [], 2)[0]
        );

        create(Shift::class, [
            'definition_id' => create(Definition::class, [], 2)[0]->id
        ])->users()->attach($user);

        return $this;
    }

    protected function truncate()
    {
        Schema::disableForeignKeyConstraints();

        Announcement::truncate();
        Store::truncate();
        DB::table('store_user')->truncate();
        User::truncate();
        Definition::truncate();
        Shift::truncate();
        UserRequest::truncate();

        Schema::enableForeignKeyConstraints();

        return $this;
    }

    protected function announcements()
    {
        create(Announcement::class, [], 25);

        return $this;
    }

    protected function users()
    {
        collect([
            [
                'name' => 'Colby Gatte',
                'email' => 'colbygatte@gmail.com',
                'password' => bcrypt('password')
            ], [
                'name' => 'Indiana Jones',
                'email' => 'indy@example.com',
                'password' => bcrypt('password')
            ], [
                'name' => 'Ben Solo',
                'email' => 'kylo@example.com',
                'password' => bcrypt('password')
            ], [
                'name' => 'Marty McFly',
                'email' => 'calvin@example.com',
                'password' => bcrypt('password')
            ],
        ])->each(function ($user) {
            create(User::class, $user);
        });

        return $this;
    }

    public function passport()
    {
        Artisan::call('passport:client', ['--password' => true, '-n' => true], new ConsoleOutput);

        DB::update('UPDATE oauth_clients SET secret = "KQBZsh4ohFJGfB8xniiNENOGCs9NIleh2JzmwVfo" WHERE id = 1;');

        Artisan::call('accesstoken', [], new ConsoleOutput);

        return $this;
    }
}
