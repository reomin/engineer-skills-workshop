# 05: パスワードハッシュ

## 目的

SHA256 だけではなぜ不十分なのかを理解し、PHP の `password_hash()` / `password_verify()` を使って正しく実装できるようにする。

---

## 事前に考えてみよう

`sha256($password)` でパスワードをハッシュ化して保存することの問題点は何だと思いますか？
「レインボーテーブル」という言葉を聞いたことはありますか？

---

## 背景知識

**なぜ SHA256 だけではダメか:**

1. SHA256 は高速すぎる
   - 1秒間に数十億回計算できる
   - 攻撃者がパスワードを総当たりで試す（ブルートフォース）コストが低い

2. ソルトがないと同じパスワードが同じハッシュになる
   - `sha256('password123')` は常に同じ値
   - レインボーテーブル（ハッシュ→パスワードの逆引き表）で一瞬で解読できる

**正しいアプローチ: bcrypt または Argon2**

- **意図的に遅い**設計（ブルートフォースのコストを上げる）
- ハッシュの中に**ソルト（ランダム文字列）が自動で含まれる**
- 同じパスワードでも毎回異なるハッシュ値が生成される

```php
// 正しい実装
$hash = password_hash('password123', PASSWORD_BCRYPT);
// => '$2y$10$ランダムなソルト込みのハッシュ'

// 検証（平文と保存済みハッシュを比較）
$isValid = password_verify('password123', $hash); // true
$isValid = password_verify('wrong',       $hash); // false
```

---

## 実習

`password.php` を開いて `TODO(human)` を実装してください。

```bash
php password.php
```

---

## 参考ドキュメント

- PHP password_hash(): https://www.php.net/manual/ja/function.password-hash.php
- PHP password_verify(): https://www.php.net/manual/ja/function.password-verify.php
- PHP サポートされるパスワードアルゴリズム: https://www.php.net/manual/ja/password.constants.php
- OWASP パスワードストレージのガイド: https://cheatsheetseries.owasp.org/cheatsheets/Password_Storage_Cheat_Sheet.html

---

## 理解の確認

「なぜ bcrypt は SHA256 より安全なのか」を「速度」「ソルト」の2つのキーワードを使って説明してください。
