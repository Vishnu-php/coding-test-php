<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run(): void {
        // $faker = Faker\Factory::create();
        // $data = [];
        // for ($i = 0; $i < 10; $i++) {
        //     $data[] = [
        //         'email' => $faker->email(),
        //         'password' => password_hash('password', PASSWORD_DEFAULT), // You should hash passwords for security
        //         'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
        //         'updated_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s')
        //     ];
        // }

        // $table = $this->table('users');
        // $table->insert($data)->save();

        try {
            $faker = Faker\Factory::create();
            $data = [];
            for ($i = 0; $i < 10; $i++) {
                $data[] = [
                    'user_id' => $faker->numberBetween(1, 10),
                    'title' => $faker->sentence(6),
                    'body' => $faker->paragraph(6),
                    'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                    'updated_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s')
                ];
            }
        
            $table = $this->table('articles');
            $table->insert($data)->save();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
