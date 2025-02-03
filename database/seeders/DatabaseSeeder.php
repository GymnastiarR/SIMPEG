<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    protected $approvers = [];

    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        // $users = \App\Models\User::factory(24)->create();
        // \App\Models\User::factory(10)->create([
        //     'name' => fake()->name(),
        //     'email' => fake()->unique()->safeEmail(),
        //     'email_verified_at' => now(),
        //     'role' => 'employee',
        //     'password' => Hash::make('password'),
        // ]);

        \App\Models\User::factory(1)->create([
            'name' => 'Muhammad Admin',
            'nip' => fake()->unique()->numerify('##########'),
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        $second_approver = \App\Models\User::factory(1)->create([
            'name' => 'Ainun Fashia Aksan',
            'nip' => fake()->unique()->numerify('##########'),
            'email' => 'ainun@gmail.com',
            'email_verified_at' => now(),
            'role' => 'approver',
            'password' => Hash::make('password'),
        ]);

        $first_approver = \App\Models\User::factory(1)->create([
            'name' => 'Muhammad Fauzan',
            'nip' => fake()->unique()->numerify('##########'),
            'email' => 'fauzan@gmail.com',
            'email_verified_at' => now(),
            'role' => 'approver',
            'password' => Hash::make('password'),
        ]);

        $first_employee = \App\Models\User::factory(1)->create([
            'name' => 'Gymnastiar Ramadhan',
            'nip' => fake()->unique()->numerify('##########'),
            'email' => 'gymnas@gmail.com',
            'email_verified_at' => now(),
            'role' => 'employee',
            'password' => Hash::make('password'),
        ]);

        $first_departement = \App\Models\Departement::factory(1)->create([
            'name' => 'Programming',
            'first_approver_id' => $first_approver[0]->id,
            'second_approver_id' => $second_approver[0]->id,
        ]);

        \App\Models\VacationRequest::factory(1)->create([
            'user_id' => $first_employee[0]->id,
            'departement_id' => $first_departement[0]->id,
            'start_date' => now()->subDays(2),
            'end_date' => now()->subDays(1),
            'reason' => 'Sakit',
            'first_approval' => true,
            'second_approval' => true,
            'first_approval_update_at' => now()->subDays(3),
            'second_approval_update_at' => now()->subDays(2),
            'created_at' => now()->subDays(4),
            'updated_at' => now(),
        ]);

        \App\Models\VacationRequest::factory(1)->create([
            'user_id' => $first_employee[0]->id,
            'departement_id' => $first_departement[0]->id,
            'start_date' => now()->subDays(30),
            'end_date' => now()->subDays(29),
            'reason' => 'Liburan',
            'first_approval' => true,
            'second_approval' => false,
            'first_approval_update_at' => now()->subDays(29),
            'second_approval_update_at' => now()->subDays(27),
            'created_at' => now()->subDays(30),
            'updated_at' => now()->subDays(29),
        ]);

        \App\Models\VacationRequest::factory(1)->create([
            'user_id' => $first_employee[0]->id,
            'departement_id' => $first_departement[0]->id,
            'start_date' => now()->subDays(45),
            'end_date' => now()->subDays(44),
            'reason' => 'Liburan',
            'first_approval' => true,
            'first_approval_update_at' => now()->subDays(47),
            'created_at' => now()->subDays(47),
            'updated_at' => now()->subDays(47),
        ]);

        \event(new \App\Events\RequestVacation($first_approver[0]->id, 'You have a new vacation request', 'approver.index'));

        \event(new \App\Events\RequestVacation($second_approver[0]->id, 'You have a new vacation request', 'approver.index'));

        \event(new \App\Events\RequestVacation($first_approver[0]->id, 'You have a new vacation request', 'approver.index'));

        \event(new \App\Events\RequestVacation($second_approver[0]->id, 'You have a new vacation request', 'approver.index'));

        \event(new \App\Events\RequestVacation($first_approver[0]->id, 'You have a new vacation request', 'approver.index'));

        \event(new \App\Events\RequestVacation($second_approver[0]->id, 'You have a new vacation request', 'approver.index'));

        \event(new \App\Events\RequestVacation($first_employee[0]->id, 'Your vacation request has been rejected', 'vacation.index'));

        \event(new \App\Events\RequestVacation($first_employee[0]->id, 'Your vacation request has been approved', 'vacation.index'));

        // \App\Models\User::factory(1)->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'email_verified_at' => now(),
        //     'role' => 'admin',
        //     'password' => Hash::make('password'),
        // ]);

        // for ($i = 0; $i < 8; $i++) {
        //     $result = \App\Models\User::factory(1)->create([
        //         'name' => 'Approver ' . $i,
        //         'nip' => '1234567890' . $i,
        //         'email' => 'approver' . $i . '@gmail.com',
        //         'email_verified_at' => now(),
        //         'role' => 'approver',
        //         'password' => Hash::make('password'),
        //     ]);

        //     $this->approvers[] = $result[0]->id;
        // }

        // $departements = [];

        // for ($i = 0; $i < 4; $i += 2) {
        //     $departement = \App\Models\Departement::factory(1)->create([
        //         'name' => 'Departement ' . $i,
        //         'first_approver_id' => $this->approvers[$i],
        //         'second_approver_id' => $this->approvers[($i + 1)],
        //     ]);
        //     $departements[] = $departement[0];
        // }

        // foreach ($users->all() as $user) {
        //     for ($i = 0; $i < 4; $i++) {
        //         \App\Models\VacationRequest::factory(1)->create([
        //             'user_id' => $user->id,
        //             'departement_id' => $departements[\rand(0, 1)],
        //             'start_date' => now()->addDays($i),
        //             'end_date' => now()->addDays($i + 1),
        //         ]);
        //     }
        // }
    }
}
