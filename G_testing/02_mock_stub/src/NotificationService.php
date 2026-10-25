<?php

declare(strict_types=1);

class NotificationService
{
    public function __construct(private Mailer $mailer) {}

    public function notifyUser(User $user): void
    {
        if (!$user->isActive) {
            return;
        }

        $this->mailer->send(
            $user->email,
            'ようこそ！',
            'アカウントが有効化されました。'
        );
    }

    public function notifyAll(array $users): int
    {
        $sent = 0;
        foreach ($users as $user) {
            if ($user->isActive) {
                $this->mailer->send($user->email, 'お知らせ', 'メッセージ');
                $sent++;
            }
        }
        return $sent;
    }
}
