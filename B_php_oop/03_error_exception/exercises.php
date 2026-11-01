<?php

declare(strict_types=1);

// --- Step 1: Exception と Error の違いを体感する ---

echo "=== Step 1: TypeError ===\n";
// TODO(human): strict_types=1 の状態で文字列を int の引数に渡して TypeError を発生させる
// try {
//     $result = addInts("aaa", 2);
// } catch (Exception $e) {
//     echo $e;
// }

try {
    $result = addInts("aaa", 2);
} catch (Throwable $e) {
    echo $e;
}

echo "こんにちは";
//              catch (Exception $e) では拾えないことを確認し、
//              catch (Throwable $e) では拾えることを確認する

function addInts(int $a, int $b): int
{
    return $a + $b;
}

try {
    // TODO(human): addInts に文字列を渡して TypeError を発生させる
    $result = addInts('hello', 1);
} catch (Exception $e) {
    echo "Exception で拾えた: " . $e->getMessage() . "\n";
} catch (Throwable $e) {
    echo get_class($e) . " で拾えた: " . $e->getMessage() . "\n";
}


echo "\n=== Step 2: DivisionByZeroError ===\n";
// TODO(human): intdiv(10, 0) を実行して DivisionByZeroError を発生させる
//              catch (Throwable $e) で拾い、クラス名とメッセージを表示する

try {
    $result = intdiv(10, 0);
} catch (Throwable $e) {
    echo get_class($e) . "で拾えた" . $e->getMessage() . "\n";
}


echo "\n=== Step 3: カスタム例外を定義する ===\n";

// TODO(human): InvalidAgeException クラスを定義する
//              Exception を継承し、コンストラクタで年齢を受け取りメッセージを自動生成する
//              例: "無効な年齢です: -5"
class InvalidAgeException extends Exception
{
    // TODO(human)
    public function __construct(int $age)
    {
        $this->message = "無効な年齢です:" . $age;
    }
}

function createUser(string $name, int $age): array
{
    // TODO(human): $age が 0 未満または 150 超の場合に InvalidAgeException を投げる
    if ($age < 0 || $age > 150) {
        throw new \InvalidAgeException($age);
    }
    return ['name' => $name, 'age' => $age];
}

try {
    $user = createUser('Alice', -5);
} catch (InvalidAgeException $e) {
    echo "カスタム例外: " . $e->getMessage() . "\n";
}


echo "\n=== Step 4: finally を使う ===\n";

// TODO(human): ファイルを開いてから例外が発生した場合でも
//              finally でファイルを確実に閉じるコードを書く
//              （tmpfile() と fclose() を使う）

$fileHandle = null;
try {
    $fileHandle = tmpfile();
    fwrite($fileHandle, "hello");
    // TODO(human): わざと例外を投げる
    throw new RuntimeException("処理中にエラーが発生");
    fwrite($fileHandle, " world"); // ← ここには到達しない
} catch (RuntimeException $e) {
    echo "例外をキャッチ: " . $e->getMessage() . "\n";
} finally {
    // TODO(human): $fileHandle が開いていれば閉じる
    if (is_resource($fileHandle)) {
        fclose($fileHandle);
    }
    echo "finally が実行された\n";
}
