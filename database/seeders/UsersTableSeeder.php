<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timestamp = Carbon::now();

        // Admin User
        $adminUserId = DB::table('users')->insertGetId([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'email_verified_at' => $timestamp,
            'password' => Hash::make('adminpassword'),
            'created_at' => $timestamp,
            'updated_at' => $timestamp
        ]);

        // Regular User
        $regularUserId = DB::table('users')->insertGetId([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'email_verified_at' => $timestamp,
            'password' => Hash::make('userpassword'),
            'created_at' => $timestamp,
            'updated_at' => $timestamp
        ]);
        $adminRole = Role::firstWhere(['name'=> 'Admin']);
        $userRole = Role::firstWhere(['name'=> 'User']);

        DB::table('user_roles')->insert(['user_id' => $adminUserId, 'role_id' => $adminRole->id]);
        DB::table('user_roles')->insert(['user_id' => $regularUserId, 'role_id' => $userRole->id]);

    }
}
