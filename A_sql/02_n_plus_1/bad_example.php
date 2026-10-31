<?php

declare(strict_types=1);

// SQLite を使ったサンプル（DB ファイルはメモリ上に作る）
$pdo = new PDO('sqlite::memory:');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// テーブル作成とデータ投入
$pdo->exec("
    CREATE TABLE users (id INTEGER PRIMARY KEY, name TEXT);
    CREATE TABLE posts (id INTEGER PRIMARY KEY, user_id INTEGER, title TEXT);

    INSERT INTO users VALUES (1,'Alice'),(2,'Bob'),(3,'Carol');
    INSERT INTO posts VALUES
        (1,1,'PHPの話'),(2,1,'SQLの話'),
        (3,2,'Gitの話'),
        (4,3,'Dockerの話'),(5,3,'テストの話'),(6,3,'セキュリティの話');
");

$queryCount = 0;

// --- N+1 が発生している悪い例 ---
echo "=== N+1 版 ===\n";

//usersにデータベースから撮ってきたusersテーブルの全ての情報を連想配列にして入れている
$users = $pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
$queryCount++;

foreach ($users as $user) {
    $postCount = $pdo->query(
        "SELECT COUNT(*) FROM posts WHERE user_id = {$user['id']}"
    )->fetchColumn();
    $queryCount++;

    echo "{$user['name']}: {$postCount}件の投稿\n";
}

echo "実行クエリ数: {$queryCount}回\n\n";

// --- TODO(human): JOIN を使って1クエリで解決する版を書く ---
echo "=== JOIN 版 ===\n";

$queryCount = 0;

// TODO(human): users と posts を LEFT JOIN + GROUP BY で結合し、
//              各ユーザーの名前と投稿数を1クエリで取得する

$result = $pdo->query("SELECT name, COUNT(posts.user_id) as post_count FROM users LEFT JOIN posts on users.id = posts.user_id GROUP BY users.id")->fetchAll(PDO::FETCH_ASSOC); // TODO(human): $pdo->query(...)->fetchAll(PDO::FETCH_ASSOC)


if ($result) {
    foreach ($result as $row) {
        echo "{$row['name']}: {$row['post_count']}件の投稿\n";
    }
    $queryCount++;
}

echo "実行クエリ数: {$queryCount}回\n";
