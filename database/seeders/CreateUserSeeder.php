<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name" => config("admin.name"),
            "email" => config("admin.email"),
            "password" => Hash::make(config("admin.password")),
            "role_id" => Role::getAdminId(),
        ]);
    }
}
