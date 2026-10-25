<?php

declare(strict_types=1);

class Mailer
{
    public function send(string $to, string $subject, string $body): void
    {
        // 実際のメール送信処理（本番コード）
        // テスト時はここに到達させてはいけない
        mail($to, $subject, $body);
    }
}
