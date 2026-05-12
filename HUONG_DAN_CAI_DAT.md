# PhoneShop - Website Bán Điện Thoại

Bài tập lớn môn Lập trình Web - PHP Laravel + SQLite

---

## Yêu cầu hệ thống

- PHP >= 8.2
- Composer >= 2.x
- Extension PHP: `pdo_sqlite`, `sqlite3`, `mbstring`, `openssl`, `tokenizer`, `xml`

---

## Hướng dẫn cài đặt và chạy

### Bước 1: Clone / giải nén project

```bash
# Nếu clone từ git
git clone <repo-url> php_bandienthoai
cd php_bandienthoai

# Nếu giải nén, vào thư mục project
cd php_bandienthoai
```

### Bước 2: Cài đặt dependencies

```bash
composer install
```

### Bước 3: Cấu hình môi trường

```bash
# Copy file .env mẫu (nếu chưa có)
cp .env.example .env

# Tạo application key
php artisan key:generate
```

File `.env` đã được cấu hình sẵn để dùng SQLite:
```
DB_CONNECTION=sqlite
SESSION_DRIVER=file
```

### Bước 4: Tạo file database SQLite

```bash
# Tạo file SQLite (nếu chưa có)
touch database/database.sqlite
# Windows:
type nul > database\database.sqlite
```

### Bước 5: Chạy migration và tạo dữ liệu mẫu

```bash
php artisan migrate:fresh --seed
```

Lệnh này sẽ:
- Xóa toàn bộ bảng cũ (nếu có) và tạo lại
- Tạo 5 tài khoản người dùng
- Tạo 6 danh mục điện thoại
- Tạo 13 sản phẩm điện thoại mẫu

### Bước 6: Khởi động server

```bash
php artisan serve
```

Mở trình duyệt và truy cập: **http://localhost:8000**

---

## Tài khoản demo

| Vai trò | Email | Mật khẩu |
|---------|-------|----------|
| Admin   | admin@phoneshop.vn | password |
| User    | user@phoneshop.vn  | password |

---

## Cấu trúc website

### Phía người dùng

| URL | Trang |
|-----|-------|
| `/` | Trang chủ |
| `/san-pham` | Danh sách điện thoại (tìm kiếm, lọc, sắp xếp) |
| `/san-pham/{slug}` | Chi tiết sản phẩm |
| `/gio-hang` | Giỏ hàng |
| `/dat-hang` | Đặt hàng (cần đăng nhập) |
| `/lich-su-don-hang` | Lịch sử đơn hàng (cần đăng nhập) |
| `/dang-nhap` | Đăng nhập |
| `/dang-ky` | Đăng ký tài khoản |

### Phía admin (cần đăng nhập admin)

| URL | Trang |
|-----|-------|
| `/admin` | Dashboard thống kê |
| `/admin/products` | Quản lý sản phẩm |
| `/admin/categories` | Quản lý danh mục |
| `/admin/orders` | Quản lý đơn hàng |
| `/admin/users` | Quản lý người dùng |

---

## Cấu trúc thư mục chính

```
php_bandienthoai/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/              # Controllers admin
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── ProductController.php
│   │   │   │   ├── CategoryController.php
│   │   │   │   ├── OrderController.php
│   │   │   │   └── UserController.php
│   │   │   ├── AuthController.php  # Đăng nhập/đăng ký
│   │   │   ├── HomeController.php  # Trang chủ
│   │   │   ├── ProductController.php
│   │   │   ├── CartController.php  # Giỏ hàng (session)
│   │   │   └── OrderController.php # Đặt hàng
│   │   └── Middleware/
│   │       └── AdminMiddleware.php # Kiểm tra quyền admin
│   └── Models/
│       ├── User.php
│       ├── Category.php
│       ├── Product.php
│       ├── Order.php
│       └── OrderItem.php
├── database/
│   ├── migrations/                 # Các file tạo bảng
│   ├── seeders/                    # Dữ liệu mẫu
│   └── database.sqlite             # File SQLite
├── resources/views/
│   ├── layouts/
│   │   ├── app.blade.php           # Layout người dùng
│   │   └── admin.blade.php         # Layout admin (có sidebar)
│   ├── auth/                       # Trang đăng nhập/đăng ký
│   ├── products/                   # Danh sách & chi tiết sản phẩm
│   ├── cart/                       # Giỏ hàng
│   ├── orders/                     # Checkout, lịch sử đơn hàng
│   ├── admin/                      # Toàn bộ views admin
│   │   ├── dashboard.blade.php
│   │   ├── products/
│   │   ├── categories/
│   │   ├── orders/
│   │   └── users/
│   ├── partials/
│   │   └── product-card.blade.php  # Card sản phẩm dùng chung
│   └── home.blade.php              # Trang chủ
└── routes/
    └── web.php                     # Tất cả routes
```

---

## Luồng hoạt động

### Luồng mua hàng
1. Người dùng xem sản phẩm → thêm vào giỏ hàng (session)
2. Vào giỏ hàng → điều chỉnh số lượng / xóa sản phẩm
3. Nhấn "Đặt hàng" → hệ thống yêu cầu đăng nhập nếu chưa có
4. Điền thông tin nhận hàng → xác nhận
5. Hệ thống lưu đơn hàng vào DB, trừ tồn kho, xóa giỏ hàng
6. Hiển thị trang thành công

### Luồng admin quản lý đơn hàng
1. Admin đăng nhập → vào Dashboard
2. Xem danh sách đơn hàng → lọc theo trạng thái
3. Xem chi tiết đơn → cập nhật trạng thái (Chờ xử lý → Đang giao → Hoàn thành)

### Phân quyền
- **Guest**: Xem sản phẩm, thêm vào giỏ hàng
- **User**: Guest + đặt hàng, xem lịch sử đơn hàng
- **Admin**: User + truy cập toàn bộ trang `/admin`

---

## Lệnh hữu ích

```bash
# Xem danh sách tất cả routes
php artisan route:list

# Reset database và tạo lại dữ liệu mẫu
php artisan migrate:fresh --seed

# Xóa cache
php artisan cache:clear && php artisan view:clear && php artisan config:clear

# Chạy server ở port khác
php artisan serve --port=8080
```

---

## Công nghệ sử dụng

- **Backend**: PHP 8.x, Laravel 11.x
- **Database**: SQLite (file `database/database.sqlite`)
- **Frontend**: Blade Template, Bootstrap 5.3, Bootstrap Icons
- **Fonts**: Google Fonts - Be Vietnam Pro
- **Session**: File-based (giỏ hàng lưu trong session)
