# B-3: Error と Exception

## 目的

PHP 7 以降の `Error` と `Exception` の2系統を区別し、`Throwable` で両方を拾う書き方を身につける。

---

## 事前に考えてみよう

`catch (Exception $e)` で全てのエラーを拾えると思いますか？
PHP 7 以降で何かが変わったことを知っていますか？

---

## 背景知識

PHP 7 以降、例外は2系統ある。どちらも `Throwable` インターフェースを実装している。

```
Throwable (interface)
├── Error          ← PHPエンジン・言語レベルの問題
│   ├── TypeError       （型エラー: string に int を渡したなど）
│   ├── ParseError      （構文エラー）
│   ├── ArithmeticError
│   │   └── DivisionByZeroError  （intdiv(1, 0) など）
│   └── ...
└── Exception      ← アプリケーションの想定内の異常
    ├── InvalidArgumentException
    ├── RuntimeException
    └── ...
```

```php
// Exception だけでは TypeError を拾えない
try {
    $result = intdiv(10, 0);
} catch (Exception $e) {
    echo "Exceptionで拾えた\n"; // ← 拾えない
}

// Throwable で両方拾える
try {
    $result = intdiv(10, 0);
} catch (Throwable $e) {
    echo get_class($e) . ': ' . $e->getMessage() . "\n"; // 拾える
}
```

---

## 実習

`exercises.php` を開いて `TODO(human)` を実装してください。

```bash
php exercises.php
```

---

## 参考ドキュメント

- PHP Throwable: https://www.php.net/manual/ja/class.throwable.php
- PHP Error クラス: https://www.php.net/manual/ja/class.error.php
- PHP Exception クラス: https://www.php.net/manual/ja/class.exception.php
- PHP 例外の継承ツリー: https://www.php.net/manual/ja/language.exceptions.php

---

## 理解の確認

「`catch (Exception $e)` と `catch (Throwable $e)` の使い分け」を
「どんな場面でどちらを使うべきか」という観点で説明してください。
