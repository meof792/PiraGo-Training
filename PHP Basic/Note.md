# Operator

- Phép <> giống !=
- Phép toán 3 chiều: <=>:

```php
<?php
    $result = $a <=> $b;
    echo $result; // -1 nếu a < b, 0 nếu a = b, 1 nếu a > b
?>
```

- Phép toán 3 ngôi

```php
<? php
    $result = $a ? $b : $c;
    // a true thì result là b, a false thì result là c
?>
```

- Toán tử null

```php
<? php
    $result = $a ?? $b;
    // a khác null (tồn tại) thì $result = a, không thì result là b
?>
```

# Loop

- while: check trước làm sau
- do while: làm xong mới check
- for: lặp có điều kiện
- for each: lặp từng phần tử

# Functions

- Toán tử ... trong hàm (... luôn là tham số cuối cùng):

```php
function sumMyNumbers(...$x) {
  $n = 0;
  $len = count($x);
  for($i = 0; $i < $len; $i++) {
    $n += $x[$i];
  }
  return $n;
}

$a = sumMyNumbers(5, 2, 6, 2, 7, 7);
echo $a;
```

# Error Handling

- try ... throw ... catch

```php
<?php
function checkNum($number) {
  if($number>1) {
    throw new Exception("Value must be 1 or below");
  }
  return true;
}

try {
  checkNum(2);
  echo 'If you see this, the number is 1 or below';
}

catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
?>
```

# String Function

- strlen($string): Hàm trả về độ dài của string
- str_word_count($string): Đếm từ (kiểu "Đếm từ" có 2 từ)
- str_repeat($string, $repeat): Lặp string repeat lần
- str_replace($search, $replace, $string): Tìm search trong replace và thay bằng string
- substr($string, $start, $length): Cắt length kí tự tính từ start của string
- strtolower($string) và strtoupper($string): Như tên gọi

# Array Function

- array_push($arr, $a, $b): Thêm lần lượt a và b vào cuối mảng arr
- array_pop($arr): Lấy phần tử cuối cùng trong $arr, xong xóa nó
- array_shift($arr): Lấy phần tử đầu tiên trong $arr, xong xóa nó
- array_unshift($arr, $a, $b): Thêm lần lượt a và b vào đầu mảng arr
- array_unique( $array): Xóa bỏ giá trị trùng

# OOP

## Tính trừu tượng

## Tính đóng gói

## Tính kế thừa

## Tính đa hình
