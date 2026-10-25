<?php

declare(strict_types=1);

// --- array_map ---

// TODO(human): ['Alice', 'Bob', 'Charlie'] を全て大文字に変換する（strtoupper を使う）
$names = ['Alice', 'Bob', 'Charlie'];
$upper = null; // TODO(human): array_map で実装する
// 期待値: ['ALICE', 'BOB', 'CHARLIE']
var_dump($upper);

// TODO(human): [1, 2, 3, 4, 5] の各要素を2乗した配列を作る
$nums = [1, 2, 3, 4, 5];
$squared = null; // TODO(human): array_map で実装する
// 期待値: [1, 4, 9, 16, 25]
var_dump($squared);


// --- array_filter ---

// TODO(human): [10, 25, 3, 88, 42] から 30 以上の要素だけ残す
$scores = [10, 25, 3, 88, 42];
$high = null; // TODO(human): array_filter で実装する
// 期待値: [88, 42] ※順序・キーは問わない
var_dump($high);

// TODO(human): ['', 'hello', null, 'world', false, '0'] から「空でない文字列」だけ残す
$mixed = ['', 'hello', null, 'world', false, '0'];
$words = null; // TODO(human): array_filter で実装する
// 期待値: ['hello', 'world']
// ヒント: array_filter にコールバックを渡さないとどうなるか試してみる
var_dump($words);


// --- array_reduce ---

// TODO(human): [100, 200, 300] の合計を array_reduce で計算する
$prices = [100, 200, 300];
$total = null; // TODO(human): array_reduce で実装する
// 期待値: 600
var_dump($total);

// TODO(human): [['name' => 'Alice', 'score' => 80], ['name' => 'Bob', 'score' => 95], ['name' => 'Carol', 'score' => 70]]
//              から最高スコアを array_reduce で求める
$users = [
    ['name' => 'Alice', 'score' => 80],
    ['name' => 'Bob',   'score' => 95],
    ['name' => 'Carol', 'score' => 70],
];
$maxScore = null; // TODO(human): array_reduce で実装する
// 期待値: 95
var_dump($maxScore);


// --- 組み合わせ ---

// TODO(human): $users から score が 75 以上のユーザーの name だけの配列を作る
//              array_filter と array_map を組み合わせて1行で書く
$highScorers = null; // TODO(human)
// 期待値: ['Alice', 'Bob']
var_dump($highScorers);
