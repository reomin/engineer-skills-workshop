<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/PasswordValidator.php';

class PasswordValidatorTest extends TestCase
{
    private PasswordValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new PasswordValidator();
    }

    // --- 正常系 ---

    // TODO(human): 有効なパスワード（8文字以上・大文字あり・数字あり）で true が返ることをテストする
    public function test_valid_password_returns_true(): void
    {
        // TODO(human)
    }

    // TODO(human): 最低要件を満たす別のパスワードで true が返ることをテストする
    public function test_another_valid_password(): void
    {
        // TODO(human)
    }


    // --- 異常系: 長さ ---

    // TODO(human): 7文字のパスワード（他の条件は満たす）で false が返ることをテストする
    public function test_too_short_password_returns_false(): void
    {
        // TODO(human)
    }

    // TODO(human): 空文字で false が返ることをテストする
    public function test_empty_password_returns_false(): void
    {
        // TODO(human)
    }


    // --- 境界値: 長さ ---

    // TODO(human): ちょうど8文字（他の条件は満たす）で true が返ることをテストする
    public function test_exactly_8_chars_returns_true(): void
    {
        // TODO(human)
    }

    // TODO(human): ちょうど7文字で false が返ることをテストする
    public function test_exactly_7_chars_returns_false(): void
    {
        // TODO(human)
    }


    // --- 異常系: 大文字なし ---

    // TODO(human): 大文字なし（8文字以上・数字あり）で false が返ることをテストする
    public function test_no_uppercase_returns_false(): void
    {
        // TODO(human)
    }


    // --- 異常系: 数字なし ---

    // TODO(human): 数字なし（8文字以上・大文字あり）で false が返ることをテストする
    public function test_no_digit_returns_false(): void
    {
        // TODO(human)
    }


    // --- 追加（自分で考える） ---

    // TODO(human): 「全部数字・大文字なし」のケースを追加する
    // TODO(human): 「長さは十分だが大文字も数字もない」ケースを追加する
    // TODO(human): 自分でもう1つ「意味のあるテストケース」を考えて追加する
}
