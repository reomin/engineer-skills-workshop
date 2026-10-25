<?php

// 警告: このファイルは学習目的で意図的に脆弱に作られています
// ローカル環境のみで使用してください

$page = $_GET['page'] ?? 'home';

echo "<h1>ページ: $page</h1>\n";

// 脆弱な include（絶対にこのコードを本番で使ってはいけない）
$filePath = $page . '.php';

if (file_exists($filePath)) {
    include $filePath;
} else {
    // file_exists を回避するため read も試す
    // （php:// フィルターは file_exists が false でも動く）
    @include $filePath;
}


// TODO(human): 上の脆弱なコードを以下の3種類の方法で修正する

// --- 修正1: ホワイトリスト ---
// function includePageSafe1(string $page): void
// {
//     $allowed = ['home', 'about', 'contact'];
//     // TODO(human)
// }

// --- 修正2: basename() を使う ---
// function includePageSafe2(string $page): void
// {
//     // TODO(human)
// }

// --- 修正3: realpath() でベースディレクトリ内かチェックする ---
// function includePageSafe3(string $page): void
// {
//     $baseDir = realpath(__DIR__ . '/pages');
//     // TODO(human)
// }
