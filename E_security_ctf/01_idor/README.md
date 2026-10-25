# E-1: IDOR（Insecure Direct Object Reference）

## 目的

IDOR の仕組みを理解し、Burp Suite を使って実際に攻撃を試し、認可チェックで防御できるようにする。

---

## 事前に考えてみよう

`GET /users/123/profile` にアクセスすると自分のプロフィールが表示されます。
`/users/124/profile` にアクセスしたとき、他人のプロフィールが見えてしまうとしたら、何が足りないと思いますか？

---

## 背景知識

IDOR = URL やパラメーターの ID を変えることで、本来アクセスできないリソースに到達できる脆弱性。

**脆弱なコードの例:**
```php
// 問題あり: ログインしているユーザーが誰かに関係なく、URL の ID で取得する
$userId = $_GET['user_id'];
$user = $db->query("SELECT * FROM users WHERE id = $userId")->fetch();
echo json_encode($user);
```

**修正後:**
```php
// ログイン中のユーザー自身のデータのみ返す
$loggedInUserId = $_SESSION['user_id'];
$requestedId    = (int)$_GET['user_id'];

if ($loggedInUserId !== $requestedId) {
    http_response_code(403);
    exit(json_encode(['error' => 'Forbidden']));
}

$user = $db->query("SELECT * FROM users WHERE id = $requestedId")->fetch();
echo json_encode($user);
```

IDOR のバリエーション:
- URL パスの ID: `/orders/456` → `/orders/457`
- クエリパラメーター: `?document_id=1` → `?document_id=2`
- POST ボディ: `{"account_id": 100}` → `{"account_id": 101`}
- ファイル名: `?file=report_alice.pdf` → `?file=report_bob.pdf`

---

## 実習

### Step 1: TryHackMe で IDOR を体験する

1. TryHackMe の IDOR ルームに挑戦する（「IDOR」で検索）
2. Burp Suite の Repeater でリクエストの ID を変えながら試す

```
TODO(human): TryHackMe の IDOR 問題を1問クリアし、以下を書く
  - 脆弱だったパラメーター
  - どう変えたら何が見えたか
  - 防御するにはどうすればよかったか
```

### Step 2: 認可チェックを PHP で実装する

```
TODO(human): 以下の要件を満たす PHP コードを書く

  - セッションからログイン中のユーザー ID を取得する
  - URL パラメーターで指定された注文 ID が、ログイン中のユーザーの注文かどうかを確認する
  - 自分の注文でなければ 403 を返す
  - 自分の注文であれば注文詳細を JSON で返す
```

---

## 参考ドキュメント

- OWASP IDOR: https://owasp.org/www-chapter-ghana/assets/slides/IDOR.pdf
- OWASP テストガイド（認可テスト）: https://owasp.org/www-project-web-security-testing-guide/latest/4-Web_Application_Security_Testing/05-Authorization_Testing/04-Testing_for_Insecure_Direct_Object_References
- TryHackMe IDOR ルーム: https://tryhackme.com/room/idor

---

## 理解の確認

「IDOR と SQL インジェクションはどちらも不正なデータアクセスを引き起こすが、根本的な違いは何か」を説明してください。
