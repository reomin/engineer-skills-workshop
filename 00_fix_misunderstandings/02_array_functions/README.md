# 02: array_map / array_filter / array_reduce

## 目的

3つの関数の動きを「変換」「絞り込み」「畳み込み」として正確に区別し、自分でコードを書けるようにする。

---

## 事前に考えてみよう

`array_map` と `array_filter` と `array_reduce` は、それぞれ「入力として配列を受け取り、何を返すか」が違います。
先を読む前に、それぞれ何を返すと思うか書いてみてください。

---

## 背景知識

```php
$nums = [1, 2, 3, 4, 5];

// array_map: 各要素を「変換」して新しい配列を返す
$doubled = array_map(fn($n) => $n * 2, $nums);
// => [2, 4, 6, 8, 10]  ← 要素数は変わらない

// array_filter: 条件に合う要素だけ「残す」（絞り込み）
$even = array_filter($nums, fn($n) => $n % 2 === 0);
// => [2, 4]  ← 要素数が減る

// array_reduce: 配列全体を「1つの値に畳み込む」
$sum = array_reduce($nums, fn($carry, $n) => $carry + $n, 0);
// => 15  ← 配列ではなくスカラー値が返る
//  第3引数の 0 は初期値（$carry の初期値）
```

---

## 実習

`exercises.php` を開いて `TODO(human)` を実装してください。

```bash
php exercises.php
```

で実行して結果を確認します。

---

## 参考ドキュメント

- array_map: https://www.php.net/manual/ja/function.array-map.php
- array_filter: https://www.php.net/manual/ja/function.array-filter.php
- array_reduce: https://www.php.net/manual/ja/function.array-reduce.php

---

## 理解の確認

3つの関数を「入力」「返り値」「要素数の変化」の3点で比較して自分の言葉でまとめてください。
