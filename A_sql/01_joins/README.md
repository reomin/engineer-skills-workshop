# A-1: SQL JOIN

## 目的

INNER JOIN と LEFT JOIN の違いを「データがない場合に何が起きるか」で区別し、自分でクエリを書けるようにする。

---

## 事前に考えてみよう

`users` テーブルに「注文をしたことがないユーザー」が含まれているとき、
INNER JOIN で users と orders を結合すると、そのユーザーは結果に含まれると思いますか？

---

## 背景知識

```
users テーブル:          orders テーブル:
id | name               id | user_id | amount
1  | Alice              1  | 1       | 500
2  | Bob                2  | 1       | 1200
3  | Carol              3  | 3       | 800
4  | Dave               ← Dave は注文なし
```

```sql
-- INNER JOIN: 両方に一致する行だけ返す（Dave は含まれない）
SELECT users.name, orders.amount
FROM users
INNER JOIN orders ON users.id = orders.user_id;
-- 結果: Alice x2, Carol x1（Dave は出てこない）

-- LEFT JOIN: 左テーブル（users）は全件。右（orders）は一致した行、なければ NULL
SELECT users.name, orders.amount
FROM users
LEFT JOIN orders ON users.id = orders.user_id;
-- 結果: Alice x2, Bob x0(NULL), Carol x1, Dave x1(NULL)
```

その他の JOIN:

- `RIGHT JOIN`: 右テーブルを全件にする（LEFT の逆）
- `FULL OUTER JOIN`: 両方を全件にする（MySQL は非対応。UNION で代用）

---

## 実習

`exercises.sql` を開いて `TODO(human)` のクエリを書いてください。

---

## 参考ドキュメント

- MySQL JOIN 構文: https://dev.mysql.com/doc/refman/8.0/en/join.html
- SQLite JOIN: https://www.sqlite.org/lang_select.html#join_operators
- Visual JOIN（図解）: https://www.codeproject.com/Articles/33052/Visual-Representation-of-SQL-Joins

---

## 理解の確認

「注文をしたことがないユーザーの名前を取得したい」という要件に対して、
なぜ INNER JOIN ではなく LEFT JOIN が必要なのかを説明してください。

LEFT JOINでは、一致した行がない場合でもNULLとして値が返されるため注文をしたことがないユーザーの名前を取得することができるから
