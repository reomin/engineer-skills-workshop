-- セットアップ
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id   INTEGER PRIMARY KEY,
    name TEXT NOT NULL
);

CREATE TABLE products (
    id    INTEGER PRIMARY KEY,
    name  TEXT NOT NULL,
    price INTEGER NOT NULL
);

CREATE TABLE orders (
    id         INTEGER PRIMARY KEY,
    user_id    INTEGER NOT NULL,
    product_id INTEGER NOT NULL,
    quantity   INTEGER NOT NULL DEFAULT 1
);

INSERT INTO users    VALUES (1,'Alice'),(2,'Bob'),(3,'Carol'),(4,'Dave');
INSERT INTO products VALUES (1,'Apple',100),(2,'Banana',80),(3,'Cherry',200);
INSERT INTO orders   VALUES
    (1,1,1,2),  -- Alice が Apple を 2個
    (2,1,3,1),  -- Alice が Cherry を 1個
    (3,3,2,5),  -- Carol が Banana を 5個
    (4,3,1,1);  -- Carol が Apple を 1個
-- Bob と Dave は注文なし


-- Q1: 全注文について、ユーザー名・商品名・数量を取得する（INNER JOIN を使う）
-- 期待出力例:
--   name  | product_name | quantity
--   Alice | Apple        | 2
--   ...

-- TODO(human):
SELECT users.name, products.name AS product_name, quantity FROM users INNER JOIN orders ON users.id = orders.user_id INNER JOIN products ON orders.product_id = products.id;


-- Q2: 全ユーザーについて、注文があれば商品名を、なければ NULL を表示する（LEFT JOIN）
-- 期待出力例:
--   name  | product_name
--   Alice | Apple
--   Alice | Cherry
--   Bob   | NULL
--   Carol | Banana
--   Carol | Apple
--   Dave  | NULL

-- TODO(human):
SELECT users.name, products.name AS product_name FROM users LEFT JOIN orders ON users.id = orders.user_id LEFT JOIN products ON orders.product_id = products.id;


-- Q3: 一度も注文したことがないユーザーの名前だけを取得する
-- ヒント: LEFT JOIN + WHERE orders.id IS NULL

-- TODO(human):
SELECT users.name, products.name AS product_name FROM users LEFT JOIN orders ON users.id = orders.user_id LEFT JOIN products ON orders.product_id = products.id WHERE orders.id IS NULL;

-- Q4: 各ユーザーの注文合計金額を取得する（注文がないユーザーは 0 で表示）
-- ヒント: LEFT JOIN + SUM + COALESCE（NULL を 0 に変換する関数）
-- 期待出力例:
--   name  | total
--   Alice | 400    (100*2 + 200*1)
--   Bob   | 0
--   Carol | 500    (80*5 + 100*1)
--   Dave  | 0

-- TODO(human):
SELECT users.name, COALESCE(SUM(quantity * price), 0) AS total FROM users LEFT JOIN orders ON users.id = orders.user_id LEFT JOIN products ON orders.product_id = products.id 
GROUP BY users.id;


-- Q5: 最も多く注文された商品の名前と合計注文数を取得する

-- TODO(human):
SELECT products.name, SUM(quantity) as count FROM users LEFT JOIN orders ON users.id = orders.user_id LEFT JOIN products ON orders.product_id = products.id 
GROUP BY products.id ORDER BY count DESC LIMIT 1;
