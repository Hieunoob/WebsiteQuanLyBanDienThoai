<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $iphone  = Category::where('slug', 'iphone')->first()->id;
        $samsung = Category::where('slug', 'samsung')->first()->id;
        $xiaomi  = Category::where('slug', 'xiaomi')->first()->id;
        $oppo    = Category::where('slug', 'oppo')->first()->id;
        $vivo    = Category::where('slug', 'vivo')->first()->id;
        $realme  = Category::where('slug', 'realme')->first()->id;

        $products = [
            // --- iPhone ---
            [
                'category_id'      => $iphone,
                'name'             => 'iPhone 15 Pro Max 256GB',
                'brand'            => 'Apple',
                'price'            => 34990000,
                'quantity'         => 25,
                'description'      => 'iPhone 15 Pro Max với chip A17 Pro mạnh mẽ nhất từ trước đến nay, màn hình Super Retina XDR 6.7 inch, hệ thống camera Pro với khả năng quay 4K ProRes. Thiết kế titan nhẹ và bền, cổng USB-C hỗ trợ USB 3.',
                'image'            => 'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-15-pro-max_1.png',
                'screen'           => '6.7 inch Super Retina XDR OLED, 120Hz ProMotion',
                'ram'              => '8GB',
                'storage'          => '256GB',
                'camera'           => '48MP Main + 12MP Ultrawide + 12MP 5x Telephoto',
                'battery'          => '4422mAh, sạc MagSafe 15W',
                'operating_system' => 'iOS 17',
                'is_featured'      => true,
            ],
            [
                'category_id'      => $iphone,
                'name'             => 'iPhone 15 128GB',
                'brand'            => 'Apple',
                'price'            => 22990000,
                'quantity'         => 30,
                'description'      => 'iPhone 15 với chip A16 Bionic, màn hình Dynamic Island 6.1 inch, camera 48MP chụp ảnh sắc nét. Cổng USB-C tiện lợi, sạc nhanh hơn.',
                'image'            => 'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-15_2.png',
                'screen'           => '6.1 inch Super Retina XDR OLED',
                'ram'              => '6GB',
                'storage'          => '128GB',
                'camera'           => '48MP Main + 12MP Ultrawide',
                'battery'          => '3877mAh',
                'operating_system' => 'iOS 17',
                'is_featured'      => true,
            ],
            [
                'category_id'      => $iphone,
                'name'             => 'iPhone 14 128GB',
                'brand'            => 'Apple',
                'price'            => 17490000,
                'quantity'         => 20,
                'description'      => 'iPhone 14 với chip A15 Bionic mạnh mẽ, camera 12MP cải tiến với chế độ Action Mode, phát hiện va chạm và SOS khẩn cấp qua vệ tinh.',
                'image'            => 'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/ip14-tim_1.png',
                'screen'           => '6.1 inch Super Retina XDR OLED',
                'ram'              => '6GB',
                'storage'          => '128GB',
                'camera'           => '12MP Main + 12MP Ultrawide',
                'battery'          => '3279mAh',
                'operating_system' => 'iOS 17',
                'is_featured'      => false,
            ],

            // --- Samsung ---
            [
                'category_id'      => $samsung,
                'name'             => 'Samsung Galaxy S24 Ultra 256GB',
                'brand'            => 'Samsung',
                'price'            => 31990000,
                'quantity'         => 15,
                'description'      => 'Galaxy S24 Ultra với bút S Pen tích hợp, chip Snapdragon 8 Gen 3, màn hình Dynamic AMOLED 2X 6.8 inch, camera 200MP siêu zoom 10x quang học.',
                'image'            => 'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/s/2/s24u-titanium-black_1.png',
                'screen'           => '6.8 inch Dynamic AMOLED 2X, 120Hz',
                'ram'              => '12GB',
                'storage'          => '256GB',
                'camera'           => '200MP + 12MP + 50MP + 10MP',
                'battery'          => '5000mAh, sạc 45W',
                'operating_system' => 'Android 14, One UI 6.1',
                'is_featured'      => true,
            ],
            [
                'category_id'      => $samsung,
                'name'             => 'Samsung Galaxy A55 5G 256GB',
                'brand'            => 'Samsung',
                'price'            => 10490000,
                'quantity'         => 35,
                'description'      => 'Galaxy A55 5G với chip Exynos 1480, màn hình Super AMOLED 6.6 inch, camera 50MP OIS, pin 5000mAh sạc nhanh 45W. Thiết kế đẹp, vỏ nhôm premium.',
                'image'            => 'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/s/a/samsung-galaxy-a55-5g.png',
                'screen'           => '6.6 inch Super AMOLED, 120Hz',
                'ram'              => '8GB',
                'storage'          => '256GB',
                'camera'           => '50MP OIS + 12MP + 5MP',
                'battery'          => '5000mAh, sạc 45W',
                'operating_system' => 'Android 14, One UI 6.1',
                'is_featured'      => true,
            ],
            [
                'category_id'      => $samsung,
                'name'             => 'Samsung Galaxy S23 FE 128GB',
                'brand'            => 'Samsung',
                'price'            => 9990000,
                'quantity'         => 22,
                'description'      => 'Galaxy S23 FE Fan Edition - phiên bản giá rẻ hơn của S23, vẫn trang bị chip Exynos 2200, camera 50MP, màn hình AMOLED 120Hz.',
                'image'            => 'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/s/2/s23-fe-tim_1.png',
                'screen'           => '6.4 inch Dynamic AMOLED 2X, 120Hz',
                'ram'              => '8GB',
                'storage'          => '128GB',
                'camera'           => '50MP OIS + 12MP + 8MP',
                'battery'          => '4500mAh, sạc 25W',
                'operating_system' => 'Android 14, One UI 6.1',
                'is_featured'      => false,
            ],

            // --- Xiaomi ---
            [
                'category_id'      => $xiaomi,
                'name'             => 'Xiaomi 14 Ultra 512GB',
                'brand'            => 'Xiaomi',
                'price'            => 29990000,
                'quantity'         => 10,
                'description'      => 'Xiaomi 14 Ultra với hệ thống camera Leica, chip Snapdragon 8 Gen 3, màn hình AMOLED 6.73 inch 120Hz. Camera chính 50MP với ống kính biến tiêu 1-inch.',
                'image'            => 'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/x/i/xiaomi-14-ultra.png',
                'screen'           => '6.73 inch AMOLED, 120Hz',
                'ram'              => '16GB',
                'storage'          => '512GB',
                'camera'           => '50MP Leica + 50MP + 50MP + 50MP',
                'battery'          => '5000mAh, sạc 90W',
                'operating_system' => 'Android 14, MIUI 15',
                'is_featured'      => true,
            ],
            [
                'category_id'      => $xiaomi,
                'name'             => 'Xiaomi Redmi Note 13 Pro 256GB',
                'brand'            => 'Xiaomi',
                'price'            => 7490000,
                'quantity'         => 40,
                'description'      => 'Redmi Note 13 Pro với camera 200MP đỉnh cao phân khúc tầm trung, chip Snapdragon 7s Gen 2, màn hình AMOLED 6.67 inch 120Hz, pin 5100mAh sạc 67W.',
                'image'            => 'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/r/e/redmi-note-13-pro-5g-1.png',
                'screen'           => '6.67 inch AMOLED, 120Hz',
                'ram'              => '8GB',
                'storage'          => '256GB',
                'camera'           => '200MP + 8MP + 2MP',
                'battery'          => '5100mAh, sạc 67W',
                'operating_system' => 'Android 13, MIUI 14',
                'is_featured'      => false,
            ],

            // --- OPPO ---
            [
                'category_id'      => $oppo,
                'name'             => 'OPPO Find X7 Ultra 256GB',
                'brand'            => 'OPPO',
                'price'            => 27990000,
                'quantity'         => 8,
                'description'      => 'OPPO Find X7 Ultra với hệ thống camera Hasselblad, chip Dimensity 9300, màn hình AMOLED 6.82 inch, sạc nhanh 100W và sạc không dây 50W.',
                'image'            => 'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/o/p/oppo-find-x7-ultra.png',
                'screen'           => '6.82 inch AMOLED 4K, 120Hz',
                'ram'              => '16GB',
                'storage'          => '256GB',
                'camera'           => '50MP + 50MP + 50MP + 64MP Periscope',
                'battery'          => '5000mAh, sạc 100W',
                'operating_system' => 'Android 14, ColorOS 14',
                'is_featured'      => true,
            ],
            [
                'category_id'      => $oppo,
                'name'             => 'OPPO Reno 11 5G 256GB',
                'brand'            => 'OPPO',
                'price'            => 10990000,
                'quantity'         => 28,
                'description'      => 'OPPO Reno 11 5G với thiết kế mỏng nhẹ, chip MediaTek Dimensity 7050, camera 50MP OIS, pin 4800mAh sạc siêu nhanh 67W.',
                'image'            => 'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/o/p/oppo-reno11-5g-bac.png',
                'screen'           => '6.7 inch AMOLED, 120Hz',
                'ram'              => '8GB',
                'storage'          => '256GB',
                'camera'           => '50MP OIS + 8MP + 2MP',
                'battery'          => '4800mAh, sạc 67W',
                'operating_system' => 'Android 14, ColorOS 14',
                'is_featured'      => false,
            ],

            // --- Vivo ---
            [
                'category_id'      => $vivo,
                'name'             => 'Vivo X100 Pro 256GB',
                'brand'            => 'Vivo',
                'price'            => 25990000,
                'quantity'         => 12,
                'description'      => 'Vivo X100 Pro với hệ thống camera Zeiss, chip Dimensity 9300, màn hình LTPO AMOLED 6.78 inch, sạc nhanh V2 chip 100W.',
                'image'            => 'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/v/i/vivo-x100-pro.png',
                'screen'           => '6.78 inch LTPO AMOLED, 120Hz',
                'ram'              => '12GB',
                'storage'          => '256GB',
                'camera'           => '50MP Zeiss + 50MP + 64MP Periscope',
                'battery'          => '5400mAh, sạc 100W',
                'operating_system' => 'Android 14, Funtouch OS 14',
                'is_featured'      => true,
            ],

            // --- Realme ---
            [
                'category_id'      => $realme,
                'name'             => 'Realme GT 5 Pro 512GB',
                'brand'            => 'Realme',
                'price'            => 16990000,
                'quantity'         => 18,
                'description'      => 'Realme GT 5 Pro flagship với chip Snapdragon 8 Gen 3, màn hình LTPO AMOLED 6.78 inch, camera 50MP Sony IMX890, sạc siêu nhanh 100W.',
                'image'            => 'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/r/e/realme-gt-5-pro.png',
                'screen'           => '6.78 inch LTPO AMOLED, 144Hz',
                'ram'              => '16GB',
                'storage'          => '512GB',
                'camera'           => '50MP Sony + 50MP Periscope + 8MP',
                'battery'          => '5400mAh, sạc 100W',
                'operating_system' => 'Android 14, Realme UI 5.0',
                'is_featured'      => false,
            ],
            [
                'category_id'      => $realme,
                'name'             => 'Realme C67 4G 128GB',
                'brand'            => 'Realme',
                'price'            => 4490000,
                'quantity'         => 50,
                'description'      => 'Realme C67 - điện thoại tầm trung thấp giá rẻ phù hợp sinh viên. Chip Snapdragon 685, màn hình IPS LCD 6.72 inch 90Hz, camera 108MP, pin 5000mAh sạc 33W.',
                'image'            => 'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/r/e/realme-c67-xanh-la.png',
                'screen'           => '6.72 inch IPS LCD, 90Hz',
                'ram'              => '6GB',
                'storage'          => '128GB',
                'camera'           => '108MP + 2MP',
                'battery'          => '5000mAh, sạc 33W',
                'operating_system' => 'Android 13, Realme UI R Edition',
                'is_featured'      => false,
            ],
        ];

        foreach ($products as $p) {
            $slug = Str::slug($p['name']) . '-' . rand(1000, 9999);
            Product::create(array_merge($p, ['slug' => $slug]));
        }
    }
}
