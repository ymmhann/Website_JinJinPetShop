# JinJin Pet Food – E-commerce Website
Website bán thức ăn thú cưng xây dựng bằng PHP/Laravel, 
tích hợp thanh toán MoMo và triển khai trên Render + Railway.

## Công nghệ sử dụng
- PHP / Laravel
- MySQL
- Postman (API Testing)
- MoMo Payment API
- Deploy: Render + Railway
## Tính năng chính
- Quản lý sản phẩm, giỏ hàng, đặt hàng
- Cơ chế chống spam đơn hàng từ khách vãng lai
- Tích hợp cổng thanh toán MoMo
- Kiểm thử API end-to-end bằng Postman
## Nhóm thực hiện
- Nhóm 5 người | Môn học: Lập trình web bằng Php và MySQL | Năm: 2026

## Hướng dẫn chạy
1. Clone repo về máy
2. Chạy `composer install`
3. Copy `.env.example` → `.env`, cập nhật thông tin database
4. Chạy `php artisan migrate --seed`
5. Chạy `php artisan serve`

## Demo
[Link deploy trên Render: https://jinjin-pet-food.onrender.com]
