-- セットアップ（テーブル作成とデータ投入）
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id   INTEGER PRIMARY KEY,
    name TEXT NOT NULL
);

CREATE TABLE orders (
    id         INTEGER PRIMARY KEY,
    user_id    INTEGER NOT NULL,
    amount     INTEGER NOT NULL,
    created_at TEXT NOT NULL
);

INSERT INTO users VALUES (1, 'Alice'), (2, 'Bob'), (3, 'Carol'), (4, 'Dave');

INSERT INTO orders VALUES
    (1,  1, 500,  '2024-03-01'),
    (2,  1, 1200, '2024-03-05'),
    (3,  1, 800,  '2024-06-10'),
    (4,  2, 300,  '2024-01-15'),
    (5,  2, 2000, '2024-07-20'),
    (6,  3, 150,  '2024-02-28'),
    (7,  3, 950,  '2024-04-11'),
    (8,  3, 400,  '2024-05-03'),
    (9,  3, 1100, '2024-08-19'),
    (10, 4, 750,  '2024-09-01');


-- Q1: 各ユーザーの注文件数を取得する
-- 期待出力例:
--   user_id | order_count
--   1       | 3
--   2       | 2
--   ...

-- TODO(human): ここにSQLを書く


-- Q2: 注文件数が3件以上のユーザーだけを取得する（HAVING を使う）
-- 期待出力例:
--   user_id | order_count
--   3       | 4

-- TODO(human): ここにSQLを書く


-- Q3: 各ユーザーの注文合計金額を取得する（多い順に並べる）
-- 期待出力例:
--   user_id | total_amount
--   3       | 2600
--   ...

-- TODO(human): ここにSQLを書く


-- Q4: 2024年4月以降の注文だけを対象に、合計金額が1000円以上のユーザーを取得する
-- （WHERE と HAVING を両方使う）

-- TODO(human): ここにSQLを書く


-- Q5: users テーブルと JOIN して、ユーザー名と注文件数を一緒に表示する

-- TODO(human): ここにSQLを書く
