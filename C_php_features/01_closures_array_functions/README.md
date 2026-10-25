# C-1: クロージャと配列関数

## 目的

クロージャ（無名関数）を変数に代入したりコールバックとして渡せるようにし、array_map / filter / reduce と組み合わせて使えるようにする。

---

## 事前に考えてみよう

関数を「変数に入れる」とどんな使い道があると思いますか？
「関数を引数として渡す」場面を想像してみてください。

---

## 背景知識

```php
// クロージャ: 名前のない関数を変数に代入できる
$double = fn(int $n): int => $n * 2;
echo $double(5); // 10

// コールバックとして渡す
$nums = [3, 1, 4, 1, 5, 9, 2, 6];
usort($nums, fn($a, $b) => $a - $b); // 昇順ソート
// => [1, 1, 2, 3, 4, 5, 6, 9]

// 外のスコープの変数を取り込む（use）
$multiplier = 3;
$triple = function(int $n) use ($multiplier): int {
    return $n * $multiplier;
};
echo $triple(4); // 12
```

アロー関数（`fn`）は外のスコープを自動でキャプチャするので `use` が不要:
```php
$multiplier = 3;
$triple = fn(int $n) => $n * $multiplier; // use 不要
```

---

## 実習

`exercises.php` を開いて `TODO(human)` を実装してください。

```bash
php exercises.php
```

---

## 参考ドキュメント

- PHP クロージャ: https://www.php.net/manual/ja/class.closure.php
- PHP アロー関数（fn）: https://www.php.net/manual/ja/functions.arrow.php
- PHP 無名関数: https://www.php.net/manual/ja/functions.anonymous.php
- usort(): https://www.php.net/manual/ja/function.usort.php

---

## 理解の確認

`function` と `fn` の違いを「スコープ」「記述量」の2点で説明してください。
