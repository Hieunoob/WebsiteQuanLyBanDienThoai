<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Tài khoản admin
        User::create([
            'name'     => 'Admin PhoneShop',
            'email'    => 'admin@phoneshop.vn',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Tài khoản user mẫu
        $users = [
            ['name' => 'Nguyễn Văn An',   'email' => 'user@phoneshop.vn'],
            ['name' => 'Trần Thị Bình',   'email' => 'binh@example.com'],
            ['name' => 'Lê Văn Cường',    'email' => 'cuong@example.com'],
            ['name' => 'Phạm Thị Dung',   'email' => 'dung@example.com'],
        ];

        foreach ($users as $u) {
            User::create([
                'name'     => $u['name'],
                'email'    => $u['email'],
                'password' => Hash::make('password'),
                'role'     => 'user',
            ]);
        }
    }
}
