<?php

declare(strict_types=1);

// --- Step 1: SHA256 の問題を体感する ---

$password = 'password123';

// 同じパスワードは常に同じハッシュになる（ソルトなし）
$hash1 = hash('sha256', $password);
$hash2 = hash('sha256', $password);

echo "SHA256 hash1: $hash1\n";
echo "SHA256 hash2: $hash2\n";
echo "一致するか: " . ($hash1 === $hash2 ? 'YES（問題あり）' : 'NO') . "\n\n";

//一致する。

// --- Step 2: password_hash を使う ---

// TODO(human): password_hash() を使って $password をハッシュ化する
//              アルゴリズムは PASSWORD_BCRYPT を使う
$bcryptHash1 = password_hash('password123', PASSWORD_BCRYPT); // TODO(human)
$bcryptHash2 = password_hash('password123', PASSWORD_BCRYPT); // TODO(human): もう1回ハッシュ化する（同じパスワードで）

echo "bcrypt hash1: $bcryptHash1\n";
echo "bcrypt hash2: $bcryptHash2\n";
echo "一致するか: " . ($bcryptHash1 === $bcryptHash2 ? 'YES' : 'NO（ソルトが違うので毎回異なる）') . "\n\n";


// --- Step 3: password_verify で検証する ---

// TODO(human): password_verify() を使って以下の検証を行う
//              正しいパスワードの検証と、間違ったパスワードの検証の両方を書く
$correctPassword = 'password123';
$wrongPassword   = 'wrongpassword';

$isCorrect = password_verify($correctPassword, $bcryptHash1);
$isWrong   = password_verify($wrongPassword, $bcryptHash2); // TODO(human): $bcryptHash1 に対して $wrongPassword を検証

echo "正しいパスワード: " . ($isCorrect ? '認証成功' : '認証失敗') . "\n";
echo "間違ったパスワード: " . ($isWrong ? '認証成功（問題あり）' : '認証失敗（正しい）') . "\n\n";


// --- Step 4: コスト（強度）を変えて速度差を体感する ---

// TODO(human): コスト 10 と コスト 12 でハッシュ化にかかる時間を計測して比較する
//              time() や microtime() を使う

$start = microtime(true);
// TODO(human): コスト10でハッシュ化
$options = ['cost' => 10];
$bcryptHash3 = password_hash('password123', PASSWORD_BCRYPT, $options);

$end = microtime(true);
echo "コスト10: " . round(($end - $start) * 1000, 2) . "ms\n";

$start = microtime(true);
// TODO(human): コスト12でハッシュ化
$options = ['cost' => 12];
$bcryptHash4 = password_hash('password123', PASSWORD_BCRYPT, $options);

$end = microtime(true);
echo "コスト12: " . round(($end - $start) * 1000, 2) . "ms\n";

echo "\nコストが上がると遅くなる = 攻撃者のブルートフォースコストが上がる\n";
