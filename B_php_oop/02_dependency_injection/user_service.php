<?php

declare(strict_types=1);

// --- データ構造 ---

class User
{
    public function __construct(
        public readonly int    $id,
        public readonly string $name,
        public readonly bool   $isActive,
    ) {}
}


// --- DI なし版（問題のあるコード）---

class UserRepositoryDirect
{
    public function find(int $id): ?User
    {
        // 本来はここで DB に接続する
        // テスト時に差し替えられない
        echo "[DB接続] user_id={$id} を検索\n";
        return new User($id, 'Alice', true);
    }
}

class UserServiceWithoutDI
{
    private UserRepositoryDirect $repo;

    public function __construct()
    {
        $this->repo = new UserRepositoryDirect(); // 自分で作っている
    }

    public function findActiveUser(int $id): ?User
    {
        $user = $this->repo->find($id);
        if ($user === null || !$user->isActive) {
            return null;
        }
        return $user;
    }
}


// --- TODO(human): DI あり版を書く ---

// Step 1: UserRepository interface を定義する
//   - find(int $id): ?User
interface UserRepositoryInterface
{
    // TODO(human)
    public function find(int $id): ?User;
}

// Step 2: 本物のリポジトリを実装する（中身はスタブでOK）
class UserRepository implements UserRepositoryInterface
{
    // TODO(human): find() を実装する（"[DB接続]" のメッセージを出力してUserを返す）
    public function find(int $id): ?User
    {
        echo "[DB接続] user_id={$id} を検索\n";
        return new User($id, 'Alice', true);
    }
}

// Step 3: UserService を DI ありで書き直す
//   - コンストラクタで UserRepositoryInterface を受け取る
class UserService
{
    // TODO(human): コンストラクタと findActiveUser() を実装する
    public function __construct(private UserRepositoryInterface $repo) {}

    public function findActiveUser(int $id): ?User
    {
        $user = $this->repo->find($id);
        if ($user === null || !$user->isActive) {
            return null;
        }
        return $user;
    }
}


// --- 動作確認 ---

echo "=== DI なし版 ===\n";
$serviceWithoutDI = new UserServiceWithoutDI();
$user = $serviceWithoutDI->findActiveUser(1);
echo $user ? "ユーザーが見つかった: {$user->name}\n" : "見つからなかった\n";

echo "\n=== DI あり版 ===\n";
// TODO(human): UserService に UserRepository を注入して同じ動作を確認する
$repo    = new UserRepository(); // TODO(human): new UserRepository()
$service = new UserService($repo); // TODO(human): new UserService($repo)
$user = $service->findActiveUser(1);
echo $user ? "ユーザーが見つかった: {$user->name}\n" : "見つからなかった\n";


echo "\n=== テスト用スタブを使う版 ===\n";
// TODO(human): UserRepositoryInterface を実装したスタブクラスを定義し、
//              find() が常に isActive=false のユーザーを返すようにする
//              それを UserService に注入して findActiveUser() が null を返すことを確認する
class InactiveUserRepositoryStub implements UserRepositoryInterface
{
    // TODO(human)
    public function find(int $id): ?User
    {
        return new User($id, 'テストユーザー', false);
    }
}

$stubRepo    = new InactiveUserRepositoryStub(); // TODO(human)
$stubService = new UserService($stubRepo); // TODO(human)
$result = $stubService->findActiveUser(1);
echo $result === null ? "null が返った（正しい）\n" : "バグあり\n";
