<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timestamp = Carbon::now();

        $roles = [
            ['name' => 'Admin', 'slug' => 'admin', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'User', 'slug' => 'user', 'created_at' => $timestamp, 'updated_at' => $timestamp]
        ];

        DB::table('roles')->insert($roles);
    }
}
