# B-1: interface と abstract class

## 目的

interface と abstract class の違いを「いつどちらを選ぶか」まで含めて説明できるようにする。

---

## 事前に考えてみよう

複数の支払い方法（クレジットカード・コンビニ・PayPay）を実装するとき、
interface と abstract class のどちらを使いますか？理由も考えてみてください。

---

## 背景知識

```php
// interface: 実装を持てない。「何ができるか」の契約だけ定義する
interface PaymentInterface {
    public function pay(int $amount): bool;
    public function getMethodName(): string;
}

// abstract class: 共通の実装を持てる。一部のメソッドだけ子クラスに任せる
abstract class AbstractPayment {
    protected string $methodName;

    // 共通処理を実装できる
    public function logPayment(int $amount): void {
        echo "[LOG] {$this->methodName}: {$amount}円\n";
    }

    // 子クラスに実装を強制する
    abstract public function pay(int $amount): bool;
}
```

使い分けの基準:

| 状況                                 | 選択                                |
| ------------------------------------ | ----------------------------------- |
| 「できること」の契約だけ定義したい   | interface                           |
| 複数クラスに共通処理を持たせたい     | abstract class                      |
| 1つのクラスが複数の「役割」を持つ    | interface（複数 implements できる） |
| 継承ツリーの中で共通の基底を作りたい | abstract class                      |

---

## 実習

`payment.php` を開いて `TODO(human)` を実装してください。

```bash
php payment.php
```

---

## 参考ドキュメント

- PHP インターフェース: https://www.php.net/manual/ja/language.oop5.interfaces.php
- PHP 抽象クラス: https://www.php.net/manual/ja/language.oop5.abstract.php
- PHP オブジェクト指向の基礎: https://www.php.net/manual/ja/language.oop5.php

---

## 理解の確認

「interface を implements したクラスで、実装し忘れたメソッドがあるとどうなるか」を
実際にコードを書いて確認してください。エラーメッセージから何が読み取れますか？

実装し忘れたクラスがあると does not implement method ~ になります。
