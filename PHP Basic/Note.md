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

```markdown


# Error Handling

# String Function

# Validate form

# Array Function

# OOP
