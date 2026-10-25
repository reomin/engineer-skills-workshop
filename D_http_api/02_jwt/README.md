# D-2: JWT とセッション認証

## 目的

JWT がなぜ「サーバーに状態を持たない認証」を実現できるのか、トークン構造から理解する。セッション認証との使い分けも判断できるようにする。

---

## 事前に考えてみよう

サーバーが10台に水平スケールしたとき、セッション認証の何が問題になると思いますか？

---

## 背景知識

### セッション認証

```
1. ログイン → サーバーがセッションを DB/メモリに保存 → セッション ID をクッキーに返す
2. 次のリクエスト → クッキーのセッション ID → サーバーが DB を参照して誰かを確認
```

問題: サーバーが複数台になるとセッションを共有する仕組みが必要（Redis など）

### JWT 認証

```
1. ログイン → サーバーが JWT（トークン）を生成して返す
2. 次のリクエスト → Authorization: Bearer <token> → サーバーがトークンの署名を検証
   ← DB を参照しない。どのサーバーでも検証できる
```

**JWT の構造（ピリオドで3分割）:**
```
eyJhbGciOiJIUzI1NiJ9           ← Header（アルゴリズム情報、base64）
.eyJzdWIiOiIxMjMiLCJuYW1lIjoiQWxpY2UifQ  ← Payload（中身、base64）
.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c  ← Signature（署名）
```

**重要な注意点:**
- JWT のペイロードは**暗号化されていない**（base64 でエンコードされているだけ）
- 誰でもデコードして中身を読める → パスワードや秘密情報を入れてはいけない
- 署名により改ざんを検知できる（中身を書き換えると署名が合わなくなる）

| | セッション | JWT |
|--|-----------|-----|
| 状態の保存先 | サーバー | クライアント |
| スケール | 共有ストレージが必要 | 不要 |
| ログアウト | 即座に無効化できる | 有効期限まで有効（ブラックリスト要） |
| DB アクセス | 毎リクエスト必要 | 不要（署名検証のみ） |

---

## 実習

### Step 1: JWT を手でデコードする

```bash
# JWT のサンプル
TOKEN="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkFsaWNlIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c"

# ピリオドで分割して2つ目（ペイロード）をデコードする
echo $TOKEN | cut -d'.' -f2 | base64 -d 2>/dev/null || \
echo $TOKEN | cut -d'.' -f2 | python3 -c "import sys,base64; print(base64.b64decode(sys.stdin.read().strip() + '==').decode())"
```

```
TODO(human): 上のコマンドを実行してペイロードの中身を確認する
             何のデータが入っていたか、また「暗号化されていない」とはどういう意味かを書く
```

### Step 2: JWT の改ざん検知を確認する

```bash
# jwt.io で JWT を作成・検証してみる
# https://jwt.io/ にアクセスしてペイロードを書き換えてみる
```

```
TODO(human): jwt.io でトークンのペイロード部分（例: "name" を変更）を書き換えて保存し、
             Signature の検証結果がどうなるか確認する
```

### Step 3: セッションと JWT の使い分けを考える

```
TODO(human): 以下のシステムにはセッション認証と JWT のどちらが適しているか、理由とともに答える

1. 一般的な Web サービス（サーバー1台、ログアウトが重要）
   → ___

2. マイクロサービス（複数サーバー、別サービスの API を呼ぶ）
   → ___

3. 銀行のシステム（不正検知のため即時ログアウトが必要）
   → ___
```

---

## 参考ドキュメント

- JWT 公式（RFC 7519）: https://www.rfc-editor.org/rfc/rfc7519
- jwt.io（JWT デバッガー・ライブラリ一覧）: https://jwt.io/
- MDN HTTP Authorization ヘッダー: https://developer.mozilla.org/ja/docs/Web/HTTP/Headers/Authorization
- PHP jwt ライブラリ（firebase/php-jwt）: https://github.com/firebase/php-jwt

---

## 理解の確認

「JWT は暗号化されていないのに、なぜ改ざんを検知できるのか」を署名の仕組みから説明してください。
