<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'iPhone',   'description' => 'Điện thoại Apple iPhone - Hệ điều hành iOS cao cấp'],
            ['name' => 'Samsung',  'description' => 'Điện thoại Samsung Galaxy - Công nghệ màn hình AMOLED hàng đầu'],
            ['name' => 'Xiaomi',   'description' => 'Điện thoại Xiaomi - Hiệu năng cao, giá hợp lý'],
            ['name' => 'OPPO',     'description' => 'Điện thoại OPPO - Camera selfie ấn tượng'],
            ['name' => 'Vivo',     'description' => 'Điện thoại Vivo - Thiết kế thời trang, camera AI'],
            ['name' => 'Realme',   'description' => 'Điện thoại Realme - Hiệu năng mạnh mẽ, giá sinh viên'],
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name'        => $cat['name'],
                'slug'        => Str::slug($cat['name']),
                'description' => $cat['description'],
            ]);
        }
    }
}
