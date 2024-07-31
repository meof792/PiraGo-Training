# Laravel Notes

## Cấu trúc thư mục cơ bản của một dự án Laravel

- **app/**: Chứa mã nguồn chính của ứng dụng.
- **bootstrap/**: Chứa file `app.php` khởi động framework.
- **config/**: Chứa tất cả các file cấu hình của ứng dụng.
- **database/**: Chứa các file migration, seeder và factories.
- **public/**: Thư mục gốc của web server, chứa file `index.php`.
- **resources/**: Chứa view, raw assets, và các file dịch.
- **routes/**: Chứa các file định nghĩa route.
- **storage/**: Chứa log, file session và các file khác.
- **tests/**: Chứa các file kiểm thử.
- **vendor/**: Chứa các package của Composer.

## Vòng đời của Request trong Laravel

# Vòng Đời Của Request Trong Laravel

```plaintext
    +--------------------+
  |     Browser        |  <-- Người dùng gửi request từ trình duyệt
  +--------------------+
            |
            v
  +--------------------+
  |    Web Server      |  <-- Web server (Apache/Nginx) nhận request
  +--------------------+
            |
            v
  +--------------------+
  |  Public/index.php  |  <-- Located in: public/index.php
  +--------------------+
            |
            v
  +--------------------+
  |  Autoload Files    |  <-- Autoload các file thông qua Composer
  +--------------------+
            |
            v
  +--------------------+
  | Create App Instance|  <-- Tạo một instance của ứng dụng Laravel
  +--------------------+
            |
            v
  +--------------------+
  | HTTP Kernel        |  <-- Located in: app/Http/Kernel.php
  +--------------------+
            |
            v
  +--------------------+
  | Register Service   |
  |   Providers        |  <-- Located in: config/app.php
  +--------------------+
            |
            v
  +--------------------+
  | Boot Service       |
  |   Providers        |  <-- Khởi động các service providers
  +--------------------+
            |
            v
  +--------------------+
  | Handle Request     |  <-- Xử lý request
  +--------------------+
            |
            v
  +--------------------+
  | Route Service      |
  |   Provider         |  <-- Xác định route và controller phù hợp
  +--------------------+
            |
            v
  +--------------------+
  | Route Middleware   |  <-- Chạy các middleware được gán cho route
  +--------------------+
            |
            v
  +--------------------+
  |   Controller       |  <-- Located in: app/Http/Controllers/
  +--------------------+
            |
            v
  +--------------------+
  |  Action Logic      |  <-- Logic của action trong controller
  +--------------------+
            |
            v
  +--------------------+
  | Return Response    |  <-- Controller trả về một response
  +--------------------+
            |
            v
  +--------------------+
  |  Middleware        |  <-- Chạy các middleware sau response (nếu có)
  +--------------------+
            |
            v
  +--------------------+
  | Return to Browser  |  <-- Response cuối cùng được gửi về trình duyệt
  +--------------------+

```

## Routing trong Laravel

- **Route Basic**: Định nghĩa route với `Route::get`, `Route::post`, etc.

```php
// Định nghĩa một route GET
Route::get('/users', function () {
    return 'Danh sách người dùng';
});
```

- **Route Parameters**: Định nghĩa các tham số động.

```php
Route::get('/user/{id}', function ($id) {
    return "Người dùng có ID: $id";
});
```

- **Route Groups**: Nhóm các route với các thuộc tính chung như middleware, prefix.
- **Named Routes**: Đặt tên cho route để dễ dàng tham chiếu.
- **Route Model Binding**: Tự động inject model vào route.

## Request và Validate Request trong Laravel

- **Request**: Dữ liệu từ client gửi lên.
- **Validation**: Sử dụng `Validator` hoặc `Form Request` để xác thực dữ liệu.
- **Custom Validation Rules**: Tạo các quy tắc xác thực tùy chỉnh.

## HTTP Session & Cache

- **Session**: Lưu trữ thông tin người dùng tạm thời, sử dụng nhiều driver như file, cookie, database.
- **Cache**: Lưu trữ tạm thời dữ liệu tốn kém thời gian truy xuất, sử dụng các driver như file, database, Redis.

## Controllers

- **Basic Controllers**: Xử lý yêu cầu HTTP.
- **Resource Controllers**: Tạo các controller chuẩn CRUD.
- **Single Action Controllers**: Controllers với một hành động duy nhất.
- **API Controllers**: Xử lý các yêu cầu API.

## Blade

- **Blade Templating**: Ngôn ngữ templating của Laravel.
- **Layouts và Sections**: Tái sử dụng code giữa các view.
- **Components & Slots**: Tạo các phần tử giao diện có thể tái sử dụng.

## Service Container

- **Dependency Injection**: Cung cấp các dependency tự động.
- **Binding**: Đăng ký các class hoặc interface vào container.
- **Resolving**: Lấy các instance từ container.

## Middleware

- **Global Middleware**: Áp dụng cho tất cả các request.
- **Route Middleware**: Áp dụng cho các route cụ thể.
- **Creating Middleware**: Tạo middleware mới.

## Collections trong Laravel

- **Collection Class**: Xử lý dữ liệu dạng mảng mạnh mẽ.
- **Collection Methods**: Các phương thức như `map`, `filter`, `reduce`.

  - Phương thức `map` được sử dụng để áp dụng một hàm lên mỗi phần tử trong collection và trả về một collection mới chứa các giá trị đã được biến đổi.

  **Cú pháp:**

  ```php
  $collection = collect([1, 2, 3, 4, 5]);
  $mapped = $collection->map(function ($item, $key) {
      return $item * 2;
  });
  // Kết quả: [2, 4, 6, 8, 10]
  ```

  - Phương thức filter được sử dụng để lọc các phần tử của collection dựa trên một hàm callback. Chỉ các phần tử mà hàm callback trả về true mới được giữ lại trong collection mới.

  **Cú pháp:**

  ```php
    $collection = collect([1, 2, 3, 4, 5]);
    $filtered = $collection->filter(function ($item) {
        return $item > 2;
    });
    // Kết quả: [3, 4, 5]
  ```

  - Phương thức reduce được sử dụng để giảm collection thành một giá trị duy nhất bằng cách lặp qua từng phần tử và áp dụng một hàm callback. Hàm callback nhận hai tham số: giá trị tích lũy và phần tử hiện tại.

  **Cú pháp:**

  ```php
    $collection = collect([1, 2, 3, 4, 5]);
  $reduced = $collection->reduce(function ($carry, $item) {
    return $carry + $item;
  }, 0);
  // Kết quả: 15 (tổng các phần tử trong collection)
  ```

## Migration

- **Creating Migrations**: Tạo file migration để thay đổi cấu trúc database.
- **Running Migrations**: Chạy các lệnh migrate để cập nhật database.
- **Rolling Back Migrations**: Hoàn tác các thay đổi của migration.

## Query Builder

- **Building Queries**: Sử dụng Fluent interface để xây dựng query.
- **Executing Queries**: Chạy các query và lấy kết quả.

## Pagination & Seeder

- **Pagination**: Phân trang kết quả truy vấn.
- **Seeder**: Tạo dữ liệu mẫu cho database.

## Relationships

- **One to One**: Quan hệ một - một.
- **One to Many**: Quan hệ một - nhiều.
- **Many to Many**: Quan hệ nhiều - nhiều.
- **Polymorphic**: Quan hệ đa hình.

## Mutators & Casting

- **Mutators**: Thay đổi giá trị trước khi lưu vào database.
- **Casting**: Ép kiểu dữ liệu của các thuộc tính model.

## API Resource

- **API Resource Classes**: Định nghĩa cách dữ liệu được trả về từ API.
- **Resource Collections**: Tập hợp các resource.

## Service Provider

- **Registering Services**: Đăng ký các dịch vụ vào container.
- **Boot Method**: Khởi động các dịch vụ khi ứng dụng chạy.
