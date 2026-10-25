<?php

declare(strict_types=1);

// --- クロージャの基礎 ---

// TODO(human): 税率 10% を適用するクロージャを $applyTax に代入する
//              引数: float $price, 返り値: float
$applyTax = null; // TODO(human)
// var_dump($applyTax(1000.0)); // 期待値: 1100.0


// TODO(human): $rate を外のスコープから取り込んで、任意の税率を適用できる関数を作る
$rate = 0.08; // 8%
$applyCustomTax = null; // TODO(human): use または fn を使う
// var_dump($applyCustomTax(1000.0)); // 期待値: 1080.0


// --- array_map ---

$products = [
    ['name' => 'Apple',  'price' => 100],
    ['name' => 'Banana', 'price' => 80],
    ['name' => 'Cherry', 'price' => 200],
];

// TODO(human): $products の各商品に 10% の税を適用した新しい配列を作る
//              price_with_tax キーを追加する（元の price は残す）
$withTax = null; // TODO(human): array_map で実装
// 期待値: [['name'=>'Apple','price'=>100,'price_with_tax'=>110], ...]
// var_dump($withTax);


// TODO(human): $products の name だけを取り出した配列を作る
$names = null; // TODO(human): array_map で実装
// 期待値: ['Apple', 'Banana', 'Cherry']
// var_dump($names);


// --- array_filter ---

// TODO(human): ['apple', 'Banana', 'cherry', 'Date', 'elderberry'] から
//              文字数が6文字以上の要素だけ残す
$fruits = ['apple', 'Banana', 'cherry', 'Date', 'elderberry'];
$longNames = null; // TODO(human): array_filter で実装
// 期待値: ['Banana', 'cherry', 'elderberry']
// var_dump(array_values($longNames)); // array_values でキーをリセット


// TODO(human): $products から price が 100 以上の商品だけ残す
$expensive = null; // TODO(human)
// 期待値: Apple(100), Cherry(200)
// var_dump(array_values($expensive));


// --- array_reduce ---

// TODO(human): $products の price の合計を array_reduce で計算する
$totalPrice = null; // TODO(human)
// 期待値: 380
// var_dump($totalPrice);


// TODO(human): $products を ['Apple' => 100, 'Banana' => 80, 'Cherry' => 200] という
//              連想配列に変換する（name をキー、price を値にする）
$priceMap = null; // TODO(human): array_reduce で実装
// var_dump($priceMap);


// --- 組み合わせ ---

$orders = [
    ['product' => 'Apple',  'qty' => 3, 'price' => 100],
    ['product' => 'Banana', 'qty' => 1, 'price' => 80],
    ['product' => 'Cherry', 'qty' => 2, 'price' => 200],
];

// TODO(human): 合計金額（qty * price の総和）を、array_map と array_reduce の組み合わせで求める
$grandTotal = null; // TODO(human)
// 期待値: 780  (300 + 80 + 400)
// var_dump($grandTotal);
