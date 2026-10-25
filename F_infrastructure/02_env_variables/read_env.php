<?php

declare(strict_types=1);

// --- Step 1: .env ファイルを手動でパースして読み込む ---
// （ライブラリなしで仕組みを理解するため）

function loadEnv(string $path): void
{
    if (!file_exists($path)) {
        throw new RuntimeException(".env ファイルが見つかりません: $path");
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        // コメント行をスキップ
        if (str_starts_with(trim($line), '#')) {
            continue;
        }

        // KEY=VALUE の形式でパース
        if (!str_contains($line, '=')) {
            continue;
        }

        [$key, $value] = explode('=', $line, 2);
        $key   = trim($key);
        $value = trim($value);

        // 既に設定されていなければ設定する
        if (!isset($_ENV[$key])) {
            putenv("$key=$value");
            $_ENV[$key] = $value;
        }
    }
}

// .env を読み込む
loadEnv(__DIR__ . '/.env');


// --- Step 2: 環境変数を読む ---

// TODO(human): getenv() と $_ENV の両方を使って以下を読み取って表示する
//   - DB_HOST
//   - DB_PORT（int にキャストする）
//   - DB_NAME
//   - APP_ENV
//   - APP_DEBUG（'true' なら bool の true に変換する）

$dbHost  = null; // TODO(human): getenv() で読む
$dbPort  = null; // TODO(human): getenv() で読んで int にキャストする
$dbName  = null; // TODO(human): $_ENV から読む
$appEnv  = null; // TODO(human)
$debug   = null; // TODO(human): 'true' なら true、それ以外は false に変換する

var_dump([
    'DB_HOST'   => $dbHost,
    'DB_PORT'   => $dbPort,
    'DB_NAME'   => $dbName,
    'APP_ENV'   => $appEnv,
    'APP_DEBUG' => $debug,
]);


// --- Step 3: 必須の環境変数が未設定の場合にエラーを出す ---

// TODO(human): 以下の関数を実装する
//              必須の環境変数が未設定なら RuntimeException を投げる
function requireEnv(string $key): string
{
    // TODO(human)
    return '';
}

try {
    $required = requireEnv('DB_PASS');
    echo "DB_PASS が設定されています\n";
} catch (RuntimeException $e) {
    echo "エラー: " . $e->getMessage() . "\n";
}

try {
    $notSet = requireEnv('NOT_EXISTING_KEY');
} catch (RuntimeException $e) {
    echo "エラー: " . $e->getMessage() . "\n";
}
