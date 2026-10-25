<?php

declare(strict_types=1);

// --- Step 1: interface を定義する ---

// TODO(human): PaymentInterface を定義する
//   - pay(int $amount): bool  → 支払い処理。成功なら true
//   - getMethodName(): string  → 支払い方法名を返す（例: 'クレジットカード'）
interface PaymentInterface
{
    // TODO(human): メソッドシグネチャを書く
}


// --- Step 2: interface を実装する ---

// TODO(human): CreditCardPayment クラスを実装する
//   - getMethodName() は 'クレジットカード' を返す
//   - pay() は 'クレジットカードで{$amount}円支払いました' を出力して true を返す
class CreditCardPayment implements PaymentInterface
{
    // TODO(human)
}

// TODO(human): ConveniencePayment クラスを実装する
//   - getMethodName() は 'コンビニ払い' を返す
//   - pay() は 'コンビニで{$amount}円支払いました' を出力して true を返す
class ConveniencePayment implements PaymentInterface
{
    // TODO(human)
}


// --- Step 3: abstract class を使うパターン ---

// TODO(human): AbstractPayment を定義する
//   - logPayment(int $amount): void  → '[LOG] {methodName}: {amount}円' を出力する（実装済み）
//   - pay(int $amount): bool  → abstract メソッド（実装は子クラスに委ねる）
//   - protected $methodName を持つ
abstract class AbstractPayment
{
    // TODO(human)
}

// TODO(human): PayPayPayment を AbstractPayment を継承して実装する
//   - $methodName = 'PayPay'
//   - pay() は logPayment() を呼んだ後 true を返す
class PayPayPayment extends AbstractPayment
{
    // TODO(human)
}


// --- 動作確認 ---

$payments = [
    new CreditCardPayment(),
    new ConveniencePayment(),
    new PayPayPayment(),
];

foreach ($payments as $payment) {
    echo $payment->getMethodName() . ': ';
    $result = $payment->pay(1000);
    echo $result ? '成功' : '失敗';
    echo "\n";
}

// 期待出力:
// クレジットカード: クレジットカードで1000円支払いました
// クレジットカード: 成功
// コンビニ払い: コンビニで1000円支払いました
// コンビニ払い: 成功
// [LOG] PayPay: 1000円
// PayPay: 成功
