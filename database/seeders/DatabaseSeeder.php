<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TaskTableSeeder::class,
            PermissionTableSeeder::class,
        ]);

        User::factory(['email' => 'admin@email.test'])->create()
            ->givePermissionTo('task-view', 'user-view');;
    }
}
