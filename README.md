
Đây là một hệ thống quản lý khách sạn được phát triển bằng **Laravel (PHP)** và **TailwindCSS**, gồm 2 phần:

- ✅ **Trang quản trị dành cho Admin** (đã hoàn thiện)
- 🛠 **Giao diện người dùng (User/Khách hàng)** (mới hoàn thiện giao diện 1 phần)

---

## 🚀 Tính Năng

### ✅ Trang quản trị (Admin) – ĐÃ HOÀN THIỆN
- Quản lý **Chi nhánh**
- Quản lý **Khách sạn**
- Quản lý **Phòng**
- Quản lý **Dịch vụ**
- Quản lý **Khuyến mãi**
- Quản lý **Khách hàng**
- Quản lý **Đặt phòng**
- Trang **Dashboard** 

## 🛠️ Công Nghệ Sử Dụng

| Thành phần     | Công nghệ            |
|----------------|----------------------|
| Backend        | Laravel (PHP)        |
| Frontend       | Blade + TailwindCSS  |
| Cơ sở dữ liệu  | Xamppp               |
| Quản lý gói    | Composer & NPM       |
| Styling        | TailwindCSS          |
| Auth (admin)   | Laravel Auth         |

---

## 📁 Các Chức Năng Quản Trị

- `Chi nhánh` – Quản lý địa điểm
- `Khách sạn` – Liên kết với chi nhánh
- `Phòng` – Quản lý loại phòng, giá, trạng thái
- `Khuyến mãi` – Tạo và áp dụng mã giảm giá
- `Khách hàng` – Lưu thông tin khách
- `Đặt phòng` – Cho phép đặt nhiều phòng, áp dụng khuyến mãi

---
## Giao diện người dùng khách hàng
Trang chủ khách hàng
<img width="1908"  alt="user-home" src="https://github.com/user-attachments/assets/9e366b04-0cde-4a30-b410-9e6f034f6462" />

---
## Giao diện quản trị Admin
Trang Dashboard
<img width="1908"  alt="hotel-manage" src="https://github.com/user-attachments/assets/c83ed09b-5516-401e-9483-c2cf64172e6e" />

Quản lý khách sạn
<img width="1908"  alt="ql-hotel" src="https://github.com/user-attachments/assets/f7e24d7d-d924-4bb3-8364-d543b64bfd73" />

Quản lý phòng
<img width="1908"  alt="ql-room" src="https://github.com/user-attachments/assets/c58f7fca-6d5d-495d-9d64-7c1bb57b193b" />

Sơ đồ khách sạn
<img width="1908"  alt="hotel-sodo" src="https://github.com/user-attachments/assets/721f963c-8a56-43e2-9c04-3972cce0b8c5" />

Form tạo khách sạn
<img width="1908"  alt="form-create-hotel" src="https://github.com/user-attachments/assets/a7228067-b3e1-494b-89b4-250e8c75151a" />

Quản lý đặt phòng 
<img width="1908"  alt="ql-booking" src="https://github.com/user-attachments/assets/f15bc05c-1543-4d3c-ae52-79076cc62aff" />

Quản lý khuyến mãi
<img width="1908"  alt="ql-km" src="https://github.com/user-attachments/assets/73d42595-c8fa-44f2-b0aa-e4287c045b32" />

Quản lý khách hàng
<img width="1908" alt="ql-kh" src="https://github.com/user-attachments/assets/a10d3ec4-382e-4838-bb01-0be8587623cd" />


## ⚙️ Hướng Dẫn Cài Đặt

### 1. Clone dự án

git clone https://github.com/camtu470/hotels.git
cd hotels

**2. Cài đặt các thư viện backend bằng Composer**
composer install

### 3. Cài đặt các gói frontend bằng NPM
npm install

**4. Tạo file cấu hình môi trường và tạo APP_KEY**
cp .env.example .env
php artisan key:generate

**5. Mở file .env và chỉnh sửa thông tin kết nối database như sau (nếu dùng XAMPP):**
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hotels_db
DB_USERNAME=root
DB_PASSWORD=

**6. Import database vào XAMPP/phpMyAdmin**
- Tạo database mới tên là hotels_db
- Import file db vào

**7. Build giao diện frontend (Vite)**
php artisan serve




