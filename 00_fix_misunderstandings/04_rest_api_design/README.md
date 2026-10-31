# 04: REST API 設計

## 目的

URL に動詞を使う設計から、「URL はリソース（名詞）・操作は HTTP メソッド」という REST の原則に切り替える。

---

## 事前に考えてみよう

`POST /create-user` と `POST /users` は何が違うと思いますか？
どちらが良い設計で、なぜだと思いますか？

---

## 背景知識

REST（Representational State Transfer）の基本ルール:

- URL は「リソース（名詞）」を表す
- 操作は HTTP メソッドで表す

```
悪い例（動詞をURLに入れている）:
  GET  /get-users
  POST /create-user
  POST /delete-user?id=123

良い例（RESTful）:
  GET    /users          ユーザー一覧
  POST   /users          ユーザー新規作成
  GET    /users/{id}     ユーザー詳細
  PUT    /users/{id}     ユーザー全体更新
  PATCH  /users/{id}     ユーザー一部更新
  DELETE /users/{id}     ユーザー削除
```

HTTP メソッドと意味:

| メソッド | 意味     | 冪等性（同じリクエストを複数回送っても同じ結果か） |
| -------- | -------- | -------------------------------------------------- |
| GET      | 取得     | あり                                               |
| POST     | 作成     | なし（毎回新しいリソースが作られる）               |
| PUT      | 全体更新 | あり                                               |
| PATCH    | 一部更新 | 場合による                                         |
| DELETE   | 削除     | あり                                               |

ネストしたリソースの表現:

```
GET /users/123/orders        ユーザー123の注文一覧
GET /users/123/orders/456    ユーザー123の注文456
```

---

## 実習

### Step 1: 設計する

```
TODO(human): 「ブログ投稿」リソースの RESTful エンドポイントを以下の操作分設計する
  - 投稿一覧の取得: GET /posts
  - 投稿の新規作成: POST /posts
  - 特定投稿の取得: GET /posts/(id)
  - 投稿の更新（全体）: PUT /posts/(id)
  - 投稿の削除: DELETE /posts/(id)
  - 特定ユーザーの投稿一覧: GET /users/(id)/posts

メソッドとURLのセットで書くこと（例: GET /posts）
```

### Step 2: ステータスコードとセットにする

```
TODO(human): 以下の操作に対して、成功時に返すべきステータスコードを書く
  - 投稿一覧の取得成功   → 200
  - 投稿の新規作成成功   → 201
  - 投稿の削除成功       → 204
  - 存在しない投稿を取得 → 404
  - バリデーションエラー → 400
```

### Step 3: curl で叩いてみる

```bash
# パブリックな REST API で動作確認する
curl -s https://jsonplaceholder.typicode.com/posts | head -50
curl -s https://jsonplaceholder.typicode.com/posts/1
curl -s -X POST https://jsonplaceholder.typicode.com/posts \
  -H "Content-Type: application/json" \
  -d '{"title": "test", "body": "hello", "userId": 1}'
```

```
TODO(human): 上の3つのコマンドを実行してレスポンスを観察する
  - 一覧と詳細でレスポンスの構造はどう違うか
  → 一覧は複数のjson要素が返ってきた、詳細は単体のjsonのみ。プロパティは同じ

  - POST のレスポンスに何が含まれているか
    "title": "test",
  "body": "hello",
  "userId": 1,
  "id": 101
  - ステータスコードが何番か（curl -o /dev/null -w "%{http_code}" で確認できる）

  ➜  03_group_by_having git:(workshop) ✗ curl -s -o /dev/null -w "%{http_code}\n" https://jsonplaceholder.typicode.com/posts | head -50
200
➜  03_group_by_having git:(workshop) ✗ curl -s -o /dev/null -w "%{http_code}\n" X POST https://jsonplaceholder.typicode.com/posts \
>   -H "Content-Type: application/json" \
  -d '{"title": "test", "body": "hello", "userId": 1}'
000
000
{
  "title": "test",
  "body": "hello",
  "userId": 1,
  "id": 101
}201


```

---

## 参考ドキュメント

- HTTP メソッド（RFC 9110）: https://www.rfc-editor.org/rfc/rfc9110#section-9
- MDN HTTP リクエストメソッド: https://developer.mozilla.org/ja/docs/Web/HTTP/Methods
- RESTful API 設計ガイド: https://restfulapi.net/
- jsonplaceholder（練習用 API）: https://jsonplaceholder.typicode.com/

---

## 理解の確認

`DELETE /users/123` と `POST /users/123/delete` の違いを「REST の原則」という言葉を使って説明してください。

REST の原則 に沿って動詞ではなく名詞で作成されたAPIである。
HTTP メソッドごとにユーサーを削除、ユーザーの作成の意味がある。

POST /users/123/deleteは、「URL はリソース（名詞）・操作は HTTP メソッド」という REST の原則に反している。
