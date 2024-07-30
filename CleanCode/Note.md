# Notes from Clean Code

## Chương 2: Meaningful Names

- Sử dụng tên dễ hiểu, đúng nghĩa
- Tránh đặt tên chung chung
- Đặt tên khác biệt có nghĩa
- Dùng tên ĐỌC được

## Chương 3: Functions

- Hàm phải nhỏ (ngắn gọn)
- Hàm chỉ nên thực hiện một mục đích duy nhất
- Đối số lý tưởng của hàm là < 3

## Chương 4: Comments

- Dùng comment là để bù đắp cho sự thất bại trong coding, trừ khi:
    - Comment giải thích mục đích
    - Comment cung cấp thông tin, cảnh báo
    - Comment pháp lý
- Nếu bắt buộc phải dùng comment, đảm bảo nó giải thích cho phần code gần nhất

## Chương 5: Error Handling

- Sử dụng Exception thay vì mã lỗi
- Xử lý ngoại lệ ở gần nơi xảy ra ngoại lệ
- Không bỏ qua ngoại lệ

## Chương 6: Smells and Heuristics

- Smells chỉ những dấu hiệu trong code chỉ ra rằng có vấn dề trong code:
    - Code trùng lặp
    - Code rối, phức tạp
- Heuristics là những nguyên tắc và hướng dẫn giúp cải thiện mã nguồn   