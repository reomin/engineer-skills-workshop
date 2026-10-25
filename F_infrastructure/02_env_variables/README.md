# F-2: 環境変数と .env ファイル

## 目的

なぜ秘密情報をコードに直書きしないのか理解し、PHP から環境変数を読む実装を書けるようにする。

---

## 事前に考えてみよう

DB のパスワードをソースコードに直書きして git に push したとき、何のリスクがあると思いますか？

---

## 背景知識

**なぜ環境変数を使うのか:**
- DB パスワード・API キーなどの秘密情報をコードに直書きしない → git 履歴に残らない
- 環境ごとに値を変えられる（開発・ステージング・本番で別の DB）
- `.env` ファイルは `.gitignore` に追加して git 管理外にする

```bash
# シェルで設定（その端末セッションのみ有効）
export DB_HOST=localhost
export DB_PASS=secret123

# 確認
echo $DB_HOST
```

```php
// PHP で読む
$host = getenv('DB_HOST');        // 関数
$pass = $_ENV['DB_PASS'];          // スーパーグローバル
$port = $_SERVER['DB_PORT'] ?? 3306; // デフォルト値付き
```

**.env ファイル（フォーマット）:**
```
DB_HOST=localhost
DB_PORT=3306
DB_NAME=myapp
DB_USER=app_user
DB_PASS=secret123
```

PHP での `.env` 読み込みには `vlucas/phpdotenv` ライブラリがよく使われる:
```php
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
```

---

## 実習

`read_env.php` を開いて `TODO(human)` を実装してください。

```bash
# .env.example を .env にコピーして値を設定する
cp .env.example .env

# PHP スクリプトを実行する
php read_env.php
```

---

## 参考ドキュメント

- PHP getenv(): https://www.php.net/manual/ja/function.getenv.php
- PHP putenv(): https://www.php.net/manual/ja/function.putenv.php
- vlucas/phpdotenv（定番 .env ライブラリ）: https://github.com/vlucas/phpdotenv
- 12-Factor App（環境変数の設計思想）: https://12factor.net/ja/config

---

## 理解の確認

`.env.example` を git に含めて `.env` を含めない理由を説明してください。
（なぜサンプルは共有するが、実際の値は共有しないのか）
