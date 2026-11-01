# D-1: HTTP ステータスコード

## 目的

主要なステータスコードを「なぜそのコードを返すのか」まで含めて説明できるようにする。特に 401 と 403 の使い分けを確実に身につける。

---

## 事前に考えてみよう

「ログイン済みの一般ユーザーが管理者ページにアクセスした」とき、何番のコードを返すべきだと思いますか？
「ログインしていないユーザーが会員限定ページにアクセスした」場合は？

---

## 背景知識

| コード | 名前                  | 意味                               | 典型的な場面                   |
| ------ | --------------------- | ---------------------------------- | ------------------------------ |
| 200    | OK                    | 成功                               | GET で取得成功                 |
| 201    | Created               | 作成成功                           | POST で新規作成                |
| 204    | No Content            | 成功（ボディなし）                 | DELETE 後                      |
| 301    | Moved Permanently     | 恒久リダイレクト                   | URL 変更                       |
| 302    | Found                 | 一時リダイレクト                   | ログイン後リダイレクト         |
| 400    | Bad Request           | リクエスト不正                     | バリデーションエラー           |
| 401    | Unauthorized          | **未認証**（誰か分からない）       | 未ログインでアクセス           |
| 403    | Forbidden             | **権限なし**（誰かは分かるが弾く） | ログイン済みだが閲覧禁止       |
| 404    | Not Found             | リソースが存在しない               | 存在しない ID を指定           |
| 409    | Conflict              | 競合                               | 重複するメールアドレスで登録   |
| 422    | Unprocessable Entity  | 意味的に処理できない               | バリデーション失敗（詳細あり） |
| 429    | Too Many Requests     | レート制限                         | API を叩きすぎ                 |
| 500    | Internal Server Error | サーバーエラー                     | 予期しない例外                 |
| 502    | Bad Gateway           | 上流サーバーエラー                 | リバースプロキシの背後でエラー |
| 503    | Service Unavailable   | サービス利用不可                   | メンテナンス中                 |

**401 vs 403 の覚え方:**

- 401: 「誰ですか？」（まずログインしてください）
- 403: 「あなたは入れません」（ログイン済みだが権限なし）

---

## 実習

### Step 1: シナリオ → コード対応

```
TODO(human): 以下のシナリオに対して適切なステータスコードを答える

1. GET /users/999 → ユーザー ID 999 が存在しない
   → ___404

2. POST /users → メールアドレスの形式が不正
   → ___400

3. POST /users → 同じメールアドレスがすでに登録済み
   → ___409

4. DELETE /users/123 → 削除成功（レスポンスボディは返さない）
   → ___204

5. GET /admin/dashboard → 認証済みの一般ユーザーがアクセス
   → ___403

6. GET /mypage → 未ログインのユーザーがアクセス
   → ___401

7. POST /api/send → 1分間に60回以上リクエストが来た
   → ___429
```

### Step 2: curl で実際に確認する

```bash
# ステータスコードだけ表示する
curl -o /dev/null -s -w "%{http_code}\n" https://httpstat.us/200
curl -o /dev/null -s -w "%{http_code}\n" https://httpstat.us/404
curl -o /dev/null -s -w "%{http_code}\n" https://httpstat.us/500

# ヘッダーを含めて表示する
curl -I https://httpstat.us/301
```

```
TODO(human): 上のコマンドを実行し、301 のレスポンスに含まれる Location ヘッダーを確認する
➜  01_status_codes git:(workshop) ✗ curl -o /dev/null -s -w "%{http_code}\n" https://httpstat.us/200
000
➜  01_status_codes git:(workshop) ✗ curl -o /dev/null -s -w "%{http_code}\n" https://httpstat.us/404
000
➜  01_status_codes git:(workshop) ✗ curl -o /dev/null -s -w "%{http_code}\n" https://httpstat.us/500
000
➜  01_status_codes git:(workshop) ✗ curl -I https://httpstat.us/301
curl: (52) Empty reply from server
```

---

## 参考ドキュメント

- MDN HTTP レスポンスステータスコード: https://developer.mozilla.org/ja/docs/Web/HTTP/Status
- RFC 9110（HTTP Semantics）: https://www.rfc-editor.org/rfc/rfc9110#section-15
- httpstat.us（ステータスコード確認用サービス）: https://httpstat.us/

---

## 理解の確認

「セキュリティ観点から、存在しないユーザーへのアクセスに 404 ではなく 403 を返すべき場面がある」
この理由を説明してください。（ヒント: ユーザー ID の存在が攻撃者に漏れると何が起きるか）
404（存在しない）と 403（存在するが権限なし）を使い分けると、攻撃者が「このIDは存在する」と判断できてしまい、ユーザーIDの列挙（enumeration）が可能になる
