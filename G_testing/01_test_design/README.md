# G-1: テストケース設計から書く

## 目的

「コードを書く前にテストケースを列挙する」習慣を身につけ、PHPUnit で自分でテストを書けるようにする。

---

## 事前に考えてみよう

`PasswordValidator::validate()` という関数をテストするとき、どんなケースをテストすべきか考えてみてください。
「正しいパスワード」だけでなく、どんな「おかしな入力」をテストすべきか。

---

## 背景知識

### テストの3分類

| 種類 | 内容 |
|------|------|
| 正常系 | 正しい入力で期待通りの結果が返る |
| 異常系 | 不正な入力でエラーや false が返る |
| 境界値 | ギリギリの値（最小・最大・ちょうど境界）で動作が正しいか |

### PHPUnit の基本

```bash
# インストール
composer require --dev phpunit/phpunit

# 実行
./vendor/bin/phpunit tests/
```

```php
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function test_add_two_positive_numbers(): void
    {
        $calc = new Calculator();
        $this->assertSame(5, $calc->add(2, 3));
    }

    public function test_add_returns_float_for_floats(): void
    {
        $calc = new Calculator();
        $this->assertEqualsWithDelta(0.3, $calc->add(0.1, 0.2), 0.0001);
    }
}
```

よく使うアサーション:
- `assertSame($expected, $actual)` — 型と値が一致
- `assertEquals($expected, $actual)` — 値が一致（型は問わない）
- `assertTrue($condition)` / `assertFalse($condition)`
- `assertNull($value)` / `assertNotNull($value)`
- `expectException(ExceptionClass::class)` — 例外が投げられることを確認

---

## 実習

### Step 1: テストケースを先に列挙する（コードを書く前に）

```
TODO(human): src/PasswordValidator.php の validate() を読んで、
             テストすべきケースを日本語で箇条書きにする（最低8件）

             正常系: ___
             異常系: ___
             境界値: ___
```

### Step 2: PHPUnit をインストールして実行環境を作る

```bash
cd workshop/G_testing/01_test_design
composer init --no-interaction
composer require --dev phpunit/phpunit
```

### Step 3: テストを実装する

`tests/PasswordValidatorTest.php` を開いて `TODO(human)` を実装してください。

```bash
./vendor/bin/phpunit tests/
```

---

## 参考ドキュメント

- PHPUnit 公式: https://docs.phpunit.de/en/latest/
- PHPUnit アサーション一覧: https://docs.phpunit.de/en/latest/assertions.html
- PHPUnit テストの書き方: https://docs.phpunit.de/en/latest/writing-tests-for-phpunit.html

---

## 理解の確認

「テストコードを先に書く（TDD）とどんな効果があるか」を自分の言葉で説明してください。
「テストを書いた後にコードを書く」と「コードを書いた後にテストを書く」の違いも含めて。
