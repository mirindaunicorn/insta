<?php
declare(strict_types=1);

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class UsersTableSeeder
 *
 */
class UsersTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     * @throws Throwable
     */
    public function run()
    {
        DB::beginTransaction();
        try {
            DB::table('users')->insert([
                'name' => 'admin',
                'email' => 'admin@email.com',
                'password' => bcrypt('123456'),
            ]);

            $id = DB::selectOne('SELECT id FROM users WHERE email=:email', ['email' => 'admin@email.com']);

            DB::table('admins')->insert([
                'user_id' => $id->id,
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
    }
}
