# E-2: LFI（Local File Inclusion）

## 目的

LFI の仕組みを理解し、脆弱なコードを自分で修正できるようにする。

---

## 事前に考えてみよう

`?page=about` というパラメーターを受け取って `include($page . '.php')` しているコードがあります。
`?page=` に何を渡せば、想定外のファイルを読めると思いますか？

---

## 背景知識

LFI = ユーザーが制御できるパスを `include` / `require` に渡してしまう脆弱性。

```php
// 脆弱な例
$page = $_GET['page'];
include($page . '.php');

// 攻撃例1: ディレクトリトラバーサル
// ?page=../../../../etc/passwd%00  （古いPHPのNullバイト攻撃）

// 攻撃例2: PHP フィルターでソースコードを読む
// ?page=php://filter/convert.base64-encode/resource=index
// → index.php の内容が base64 でそのまま表示される

// 攻撃例3: ログファイルインジェクション
// アクセスログに PHP コードを書き込んでおき、ログを include する
```

`vulnerable.php` は意図的に脆弱なコードになっている。ローカルで試して攻撃が成立することを確認する。

---

## 実習

### Step 1: 脆弱なコードを観察する

```bash
# ローカルサーバーを立ち上げる
php -S localhost:8080

# 攻撃を試す（ローカル環境なので安全）
curl "http://localhost:8080/vulnerable.php?page=../../../etc/hosts"
curl "http://localhost:8080/vulnerable.php?page=php://filter/convert.base64-encode/resource=vulnerable"
```

```
TODO(human): 上の攻撃を実際に試し、何が返ってきたか記録する
```

### Step 2: 修正する

```
TODO(human): vulnerable.php を修正して LFI を防ぐ
             以下の3つのアプローチをそれぞれ試す

  1. ホワイトリスト方式（許可するページ名を配列で定義する）
  2. basename() を使う（ディレクトリ部分を除去する）
  3. realpath() で正規化してベースディレクトリ内かチェックする
```

### Step 3: TryHackMe で LFI を体験する

```
TODO(human): TryHackMe の「LFI」タグの問題を1問解いて Writeup を書く
  - 問題名
  - 使ったペイロード
  - 何のファイルが読めたか
  - 防御方法
```

---

## 参考ドキュメント

- OWASP パストラバーサル: https://owasp.org/www-community/attacks/Path_Traversal
- PHP include / require: https://www.php.net/manual/ja/function.include.php
- PHP サポートするラッパー（php://）: https://www.php.net/manual/ja/wrappers.php
- PHP realpath(): https://www.php.net/manual/ja/function.realpath.php
- TryHackMe LFI ルーム: https://tryhackme.com/room/fileinc

---

## 理解の確認

`basename()` だけでは LFI を完全には防げない場合がある。どんなケースか考えてみてください。
（ヒント: `php://` プロトコルはどうなるか）
