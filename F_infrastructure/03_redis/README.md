# F-3: Redis とキャッシュ

## 目的

Redis がなぜ必要なのか、「メモリ上のデータストア」としての役割を理解し、セッション・キャッシュ・キューへの使い方を説明できるようにする。

---

## 事前に考えてみよう

DB に毎回アクセスするのではなく、一度取得した結果をメモリに保存しておくと何が嬉しいですか？
また、何が問題になりますか？

---

## 背景知識

Redis = メモリ上で動くキーバリューストア。
「辞書型の超高速な一時保管場所」というイメージ。

**主な用途:**

| 用途 | 説明 |
|------|------|
| キャッシュ | DB クエリ結果や HTML を保存して次回 DB を叩かない |
| セッション | 複数サーバーでセッションを共有する |
| ジョブキュー | 非同期タスクをキューに積む |
| レートリミット | 「1分に60回まで」などのカウンタ |
| リアルタイム | チャットのオンラインユーザーリストなど |

**基本操作（Redis CLI）:**
```bash
redis-cli

SET user:123 '{"name":"Alice","age":30}'   # 文字列をセット
GET user:123                               # 取得
SETEX cache:posts 60 '...'                 # 60秒の有効期限付きでセット
TTL cache:posts                            # 残り有効期限を確認
DEL user:123                               # 削除
EXISTS user:123                            # 存在確認（1 or 0）
KEYS user:*                                # パターンで一覧取得（本番での多用は禁止）
```

**キャッシュの基本パターン（PHP）:**
```php
$cacheKey = "user:{$userId}";
$cached = $redis->get($cacheKey);

if ($cached !== false) {
    return json_decode($cached, true); // キャッシュヒット
}

// キャッシュミス → DB から取得
$user = $db->findUser($userId);
$redis->setex($cacheKey, 3600, json_encode($user)); // 1時間キャッシュ
return $user;
```

**キャッシュ無効化の問題:**
DB のデータを更新した後、キャッシュが古い状態になる（Cache Stampede / Stale Cache）。
- 更新時にキャッシュを削除する
- 有効期限を短くする
- キャッシュキーにバージョンを含める

---

## 実習

### Step 1: Redis をインストールして CLI で操作する

```bash
# Mac
brew install redis
brew services start redis

# 動作確認
redis-cli ping  # PONG が返れば OK
```

```
TODO(human): redis-cli で以下を実行する
  1. SET name "Alice" を実行する
  2. GET name で取得する
  3. SETEX temp_key 10 "expires soon" で10秒TTLでセットする
  4. TTL temp_key で残り時間を確認する
  5. 10秒後に GET temp_key を実行して nil が返ることを確認する
```

### Step 2: PHP から Redis を使う

```bash
# Predis ライブラリをインストール
composer require predis/predis
```

```php
require 'vendor/autoload.php';
$redis = new Predis\Client();

// TODO(human): 「DBアクセスを模倣する関数」と「Redisキャッシュを使う関数」を実装する
// fetchUserFromDB($id)   → 0.1秒 sleep してユーザーを返す（DB の遅さを模倣）
// fetchUserWithCache($id) → キャッシュがあれば即返し、なければ DB から取ってキャッシュする
```

```
TODO(human): fetchUserWithCache を3回連続で呼び、
             1回目と2回目以降で所要時間が違うことを確認する
```

### Step 3: セッションへの応用を考える

```
TODO(human): 以下の問いに答える
  1. PHP のデフォルトのセッションはどこに保存されるか（php.ini の session.save_handler）
  2. それをサーバー10台に水平スケールしたとき何が問題になるか
  3. Redis にセッションを保存することでその問題がどう解決されるか
```

---

## 参考ドキュメント

- Redis 公式: https://redis.io/docs/latest/
- Redis コマンドリファレンス: https://redis.io/docs/latest/commands/
- Predis（PHP クライアント）: https://github.com/predis/predis
- PHP session_set_save_handler: https://www.php.net/manual/ja/function.session-set-save-handler.php

---

## 理解の確認

「キャッシュを使うと速くなるが、データが古くなる可能性がある」問題を「整合性とパフォーマンスのトレードオフ」という言葉を使って説明してください。
