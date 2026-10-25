<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/User.php';
require_once __DIR__ . '/../src/Mailer.php';
require_once __DIR__ . '/../src/NotificationService.php';

class NotificationServiceTest extends TestCase
{
    // --- notifyUser のテスト ---

    // TODO(human): isActive=true のユーザーに対して mailer->send() が1回呼ばれることをモックで検証する
    //              送り先のメールアドレスも with() で検証すること
    public function test_notifyUser_sends_mail_to_active_user(): void
    {
        // TODO(human): Mailer のモックを作る
        $mailerMock = null;

        // TODO(human): send() が1回・正しいアドレスで呼ばれることを設定する

        // TODO(human): NotificationService を作ってモックを注入する
        $service = null;

        // TODO(human): isActive=true のユーザーを作る
        $user = null;

        // TODO(human): notifyUser を呼ぶ
    }

    // TODO(human): isActive=false のユーザーに対して mailer->send() が呼ばれないことをモックで検証する
    public function test_notifyUser_does_not_send_mail_to_inactive_user(): void
    {
        // TODO(human): Mailer のモックを作り、send() が never() 呼ばれないことを設定する

        // TODO(human)
    }


    // --- notifyAll のテスト ---

    // TODO(human): アクティブユーザー2人・非アクティブ1人のリストで
    //              send() が2回呼ばれることを検証し、戻り値が 2 であることを確認する
    public function test_notifyAll_sends_only_to_active_users(): void
    {
        $users = [
            new User(1, 'alice@example.com', true),
            new User(2, 'bob@example.com',   false),
            new User(3, 'carol@example.com', true),
        ];

        // TODO(human): Mailer のモックを作り、send() が exactly(2) 呼ばれることを設定する
        $mailerMock = null;

        // TODO(human): notifyAll を呼んで戻り値を検証する
        $service = null;
        // $result = $service->notifyAll($users);
        // $this->assertSame(2, $result);
    }


    // --- スタブを使う場面（比較） ---

    // TODO(human): 「send() が呼ばれたかどうかを検証しない」場合は createStub() を使う
    //              上の test_notifyUser_sends_mail_to_active_user を
    //              createStub() で書き直したバージョンを作る（検証の行を削除する）
    //              そして「スタブ版とモック版の何が違うか」をコメントで書く
    public function test_with_stub_no_verification(): void
    {
        // TODO(human): createStub() で Mailer を作り、notifyUser を呼ぶだけ（検証なし）
        // このテストは何を確認しているか、何を確認していないか。
    }
}
