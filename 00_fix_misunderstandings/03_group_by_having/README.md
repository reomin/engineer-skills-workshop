# 03: GROUP BY と HAVING

## 目的

GROUP BY が「集約」であり「並び替え」ではないことを理解し、WHERE との使い分けができるようにする。

---

## 事前に考えてみよう

`GROUP BY user_id` は何をしていると思いますか？
「user_id が同じ行を...」という形で答えてみてください。

---

## 背景知識

```sql
-- GROUP BY: 同じ値の行を1つにまとめる（集約）
-- HAVING: まとめた後のグループに条件をかける（WHERE はまとめる前）

SELECT user_id, COUNT(*) AS post_count
FROM posts
GROUP BY user_id        -- user_id が同じ行を1グループにまとめる
HAVING COUNT(*) > 10;  -- まとめた後、10件超のグループだけ残す
```

WHERE との違い:

```sql
-- WHERE: グループ化「前」に行を絞る
SELECT user_id, COUNT(*) AS post_count
FROM posts
WHERE created_at > '2024-01-01'  -- まず2024年以降の行だけにする
GROUP BY user_id
HAVING COUNT(*) > 10;            -- その後グループを絞る
```

集約関数（GROUP BY と一緒に使えるもの）:
- `COUNT(*)` - 件数
- `SUM(column)` - 合計
- `AVG(column)` - 平均
- `MAX(column)` - 最大値
- `MIN(column)` - 最小値

---

## 実習

`exercises.sql` を開いて `TODO(human)` のクエリを書いてください。

SQLite で手元で試す場合:
```bash
sqlite3 workshop.db < exercises.sql
```

---

## 参考ドキュメント

- MySQL GROUP BY: https://dev.mysql.com/doc/refman/8.0/en/group-by-modifiers.html
- MySQL HAVING: https://dev.mysql.com/doc/refman/8.0/en/select.html
- SQLite SELECT（GROUP BY / HAVING）: https://www.sqlite.org/lang_select.html
- SQL 集約関数: https://dev.mysql.com/doc/refman/8.0/en/aggregate-functions.html

---

## 理解の確認

「WHERE と HAVING の違いを、処理の順序という観点から」自分の言葉で説明してください。
「まず○○して、次に○○する」という形で答えてみてください。
