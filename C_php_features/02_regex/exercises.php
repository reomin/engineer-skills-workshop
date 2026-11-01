<?php

declare(strict_types=1);

// --- Step 1: パターンを読む ---

// TODO(human): 以下のパターンが何にマッチするかコメントで説明する
$patterns = [
    '/^\d{4}-\d{2}-\d{2}$/',                                    // TODO: 何にマッチするか 4桁の数字-2桁の数字-2桁の数字 生年月日
    '/https?:\/\/[^\s]+/',                                        // TODO: 何にマッチするか https or http url
    '/^[0-9]{3}-[0-9]{4}$/',                                     // TODO: 何にマッチするか 0~9で構成された三桁の数字-0~9で構成された四桁の数字 郵便番号
    '/^\+?[0-9\-\(\)\s]{10,}$/',                                 // TODO: 何にマッチするか 電話番号
];

foreach ($patterns as $i => $pattern) {
    echo "pattern[$i]: $pattern\n";
}


// --- Step 2: preg_match でバリデーションを書く ---

function validateDate(string $date): bool
{
    // TODO(human): YYYY-MM-DD 形式かどうかを正規表現で検証する
    $result = preg_match('/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$/', $date);
    if ($result == 1) {
        return true;
    }
    return false; // TODO
}

$dates = ['2024-03-15', '24-3-15', '2024/03/15', '2024-13-01', 'not-a-date'];
foreach ($dates as $date) {
    $result = validateDate($date) ? 'OK' : 'NG';
    echo "validateDate('$date'): $result\n";
}
// 期待値: 2024-03-15 → OK, それ以外 → NG


echo "\n";

function validateEmail(string $email): bool
{
    // TODO(human): メールアドレスの正規表現バリデーションを書く
    $result = preg_match('/\A[a-zA-Z0-9_.+-]+@([a-zA-Z0-9-]+\.)+[a-zA-Z0-9-]+\z/', $email);
    if ($result == 1) {
        return true;
    }
    return false; // TODO
}

$emails = ['user@example.com', 'invalid-email', 'user@', '@example.com', 'a+b@x.co.jp'];
foreach ($emails as $email) {
    $result = validateEmail($email) ? 'OK' : 'NG';
    echo "validateEmail('$email'): $result\n";
}


echo "\n";

die;

function validateJapanesePhone(string $phone): bool
{
    // TODO(human): 日本の電話番号（090-1234-5678 または 0312345678 形式）の正規表現を書く
    return false; // TODO
}

$phones = ['090-1234-5678', '09012345678', '03-1234-5678', '0312345678', '123', '+81-90-1234-5678'];
foreach ($phones as $phone) {
    $result = validateJapanesePhone($phone) ? 'OK' : 'NG';
    echo "validatePhone('$phone'): $result\n";
}


// --- Step 3: preg_replace で文字列を変換する ---

echo "\n";

// TODO(human): 連続する空白を1つのスペースに置換する
$messy = "hello   world\t\tthis  is   PHP";
$clean = preg_replace('//', $messy);
echo "clean: $clean\n"; // 期待値: "hello world this is PHP"


// TODO(human): HTML タグを全て除去する
$html = "<p>Hello <strong>World</strong>, this is <a href='#'>PHP</a>!</p>";
$text = null; // TODO(human)
echo "text: $text\n"; // 期待値: "Hello World, this is PHP!"


// --- Step 4: キャプチャグループを使う ---

echo "\n";

// TODO(human): '2024-03-15' から年・月・日を別々に取り出す
$dateStr = '2024-03-15';
preg_match('/TODO(human): パターンをここに書く/', $dateStr, $matches);
// echo "年: {$matches[1]}, 月: {$matches[2]}, 日: {$matches[3]}\n";


// TODO(human): 文章中の全ての URL を取り出す
$text = 'Visit https://example.com or http://php.net for more info.';
preg_match_all(
    '/TODO(human): パターンをここに書く/',
    $text,
    $urlMatches
);
// var_dump($urlMatches[0]); // 期待値: ['https://example.com', 'http://php.net']
