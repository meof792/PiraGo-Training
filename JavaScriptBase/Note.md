# JS note

## HTML DOM

- HTML DOM là tiêu chuẩn về cách lấy, thay đổi, thêm hoặc xóa các phần tử HTML

## Variable

- Khi nào sử dụng var, let hoặc const?

    1. Luôn khai báo biến

    2. Luôn sử dụng constnếu giá trị không nên thay đổi

    3. Luôn sử dụng constnếu kiểu không nên thay đổi (Mảng và Đối tượng)

    4. Chỉ sử dụng letnếu bạn không thể sử dụngconst

    5. Chỉ sử dụng varnếu bạn PHẢI hỗ trợ trình duyệt cũ.

## Operator

_dễ_

## Loop

- for in trong js giống for each

```js
for (key in object) {
  // code block to be executed
}

// or

const numbers = [45, 4, 9, 16, 25];

let txt = "";
for (let x in numbers) {
  txt += numbers[x];
}
```

## Functions

- Trong code dưới, việc thêm () khi truy cập hay không sẽ tạo ra 2 kết quả khác nhau

```js
function toCelsius(fahrenheit) {
  return (5/9) * (fahrenheit-32);
}

let value1 = toCelsius(102);
let value2 = toCelsius;
```

- `value` sẽ trả về kết quả của phép toán, trong khi `value2` sẽ trả về toàn bộ đoạn code của function

## Error Handling

- Câu lệnh `try` định nghĩa một khối mã để chạy (để thử).

- Câu lệnh `catch` định nghĩa một khối mã để xử lý mọi lỗi.

- Câu lệnh `finally` định nghĩa một khối mã chạy bất kể kết quả ra sao.

- Câu lệnh `throw` định nghĩa một lỗi tùy chỉnh.

## 