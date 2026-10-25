# A-2: N+1 問題

## 目的

N+1 問題が発生するコードのパターンを見抜き、JOIN を使って1クエリで解決できるようにする。

---

## 事前に考えてみよう

100人のユーザー情報を取得した後、各ユーザーの投稿数を表示したいとします。
ループの中で毎回 SQL を叩くと、合計何回 SQL が実行されると思いますか？

---

## 背景知識

N+1 問題: N 件取得した後、ループ内でさらに N 回クエリを投げてしまうこと。

```php
// 悪い例（100ユーザーなら101回のクエリが走る）
$users = $pdo->query("SELECT * FROM users")->fetchAll();  // 1回目

foreach ($users as $user) {
    $posts = $pdo->query(
        "SELECT COUNT(*) FROM posts WHERE user_id = {$user['id']}"
    )->fetchColumn();  // ← これが N 回走る
    echo "{$user['name']}: {$posts}件\n";
}
```

**なぜ問題か:**
- DB への接続・クエリ解析・結果返却のオーバーヘッドが N 回分かかる
- ユーザーが増えるほど線形に遅くなる
- 本番では数百〜数千のクエリが走ることもある

**解決策: JOIN で1クエリにまとめる**

```sql
SELECT users.id, users.name, COUNT(posts.id) AS post_count
FROM users
LEFT JOIN posts ON users.id = posts.user_id
GROUP BY users.id, users.name;
```

---

## 実習

`bad_example.php` を開いて N+1 が発生している箇所を特定し、修正してください。

```bash
php bad_example.php
```

---

## 参考ドキュメント

- Laravel Eager Loading（N+1 解消）: https://laravel.com/docs/eloquent-relationships#eager-loading
- PHP PDO: https://www.php.net/manual/ja/book.pdo.php
- MySQL EXPLAIN の読み方: https://dev.mysql.com/doc/refman/8.0/en/explain-output.html

---

## 理解の確認

N+1 問題が起きているコードと、JOIN で解決したコードを並べて「何が違うのか」を説明してください。
「クエリの回数」と「パフォーマンス」の両方に触れてください。
