# G-2: モックとスタブを使い分ける

## 目的

「スタブ = 戻り値の制御」「モック = 呼び出しの検証」という違いを理解し、PHPUnit で両方を書けるようにする。

---

## 事前に考えてみよう

`NotificationService::notifyUser()` をテストするとき、実際にメールを送ってしまうと何が問題ですか？
テスト中に「メールが送られた」ことをどうやって確認すればいいと思いますか？

---

## 背景知識

| 用語 | 目的 | PHPUnit のメソッド |
|------|------|--------------------|
| スタブ | 「このメソッドはこの値を返せ」と指定する | `createStub()` / `willReturn()` |
| モック | 「このメソッドが○回呼ばれたか」まで検証する | `createMock()` / `expects()` / `with()` |

```php
// スタブ: 戻り値だけ制御する
$stub = $this->createStub(UserRepository::class);
$stub->method('find')
     ->willReturn(new User(1, 'alice@example.com', true));

// モック: 呼び出し回数・引数まで検証する
$mock = $this->createMock(Mailer::class);
$mock->expects($this->once())              // 1回だけ呼ばれることを期待
     ->method('send')
     ->with(                               // 引数も検証できる
         'alice@example.com',
         'ようこそ！',
         $this->anything()
     );
```

---

## 実習

`tests/NotificationServiceTest.php` を開いて `TODO(human)` を実装してください。

```bash
cd workshop/G_testing/02_mock_stub
composer init --no-interaction
composer require --dev phpunit/phpunit
./vendor/bin/phpunit tests/
```

---

## 参考ドキュメント

- PHPUnit モックオブジェクト: https://docs.phpunit.de/en/latest/test-doubles.html
- PHPUnit expects(): https://docs.phpunit.de/en/latest/test-doubles.html#expectations
- `createMock` vs `createStub`: https://docs.phpunit.de/en/latest/test-doubles.html#stubs

---

## 理解の確認

以下の問いに答えてください。

「`createStub()` で作ったオブジェクトで `send()` が呼ばれなかった場合、テストは失敗しますか？」
「`createMock()` + `expects($this->once())` の場合はどうなりますか？」
