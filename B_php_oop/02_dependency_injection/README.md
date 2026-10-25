# B-2: 依存性の注入（DI）

## 目的

「クラスが自分で依存先を作る」問題を理解し、コンストラクタ注入でテストしやすいコードに書き直せるようにする。

---

## 事前に考えてみよう

`UserService` が内部で `new UserRepository()` を呼んでいるとき、
テストで「DBに接続しないモック」に差し替えることはできると思いますか？

---

## 背景知識

DI（Dependency Injection）= 「依存するオブジェクトを自分で作らず、外から受け取る」

```php
// DI なし（テストしにくい）
class UserService {
    private UserRepository $repo;

    public function __construct() {
        $this->repo = new UserRepository(); // DB に繋がないと動かない
    }
}

// DI あり（テストしやすい）
class UserService {
    public function __construct(
        private UserRepository $repo  // 外から受け取る
    ) {}
}

// テスト時はモックを渡せる
$mockRepo = $this->createMock(UserRepository::class);
$service  = new UserService($mockRepo);  // DB 不要でテストできる
```

なぜ DI が良いか:
- テスト: 依存先をモックに差し替えられる
- 再利用: 異なる実装を差し替えられる（例: MySQL → PostgreSQL）
- 可読性: コンストラクタを見るだけで依存関係が分かる

---

## 実習

`user_service.php` を開いて `TODO(human)` を実装してください。

```bash
php user_service.php
```

---

## 参考ドキュメント

- PHP-FIG PSR-11（DI コンテナインターフェース）: https://www.php-fig.org/psr/psr-11/
- Laravel サービスコンテナ: https://laravel.com/docs/container
- PHP コンストラクタプロモーション（PHP 8.0+）: https://www.php.net/manual/ja/language.oop5.decon.php#language.oop5.decon.constructor.promotion

---

## 理解の確認

「DI コンテナ」という言葉を調べて、手動 DI との違いを1行で説明してください。
（Laravel の `app()->make()` や `bind()` がそれです）
