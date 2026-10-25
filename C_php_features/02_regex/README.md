# C-2: 正規表現

## 目的

正規表現のメタ文字を読めるようにし、PHP の `preg_match` / `preg_replace` / `preg_match_all` を使ったバリデーションと文字列操作を書けるようにする。

---

## 事前に考えてみよう

`/^\d{4}-\d{2}-\d{2}$/` というパターンを見て、何にマッチするか分かりますか？

---

## 背景知識

よく使うメタ文字:

| パターン | 意味 | 例 |
|---------|------|---|
| `\d` | 数字（0-9） | `\d{4}` → 4桁の数字 |
| `\w` | 英数字 + アンダースコア | |
| `\s` | 空白文字（スペース・タブ・改行）| |
| `.` | 任意の1文字（改行以外）| |
| `^` | 文字列の先頭 | |
| `$` | 文字列の末尾 | |
| `+` | 1回以上の繰り返し | |
| `*` | 0回以上の繰り返し | |
| `?` | 0か1回 | `https?` → http または https |
| `{n}` | n回 | `\d{3}` → 3桁 |
| `{n,m}` | n回以上m回以下 | |
| `[abc]` | a か b か c | `[a-z]` → 小文字英字 |
| `[^abc]` | a・b・c 以外 | |
| `(abc)` | グループ化・キャプチャ | |

```php
// preg_match: マッチするか確認（1 or 0）
$matched = preg_match('/^\d{4}-\d{2}-\d{2}$/', '2024-03-15'); // 1

// キャプチャグループ
preg_match('/(\d{4})-(\d{2})-(\d{2})/', '2024-03-15', $matches);
// $matches[0] = '2024-03-15'
// $matches[1] = '2024'
// $matches[2] = '03'
// $matches[3] = '15'

// preg_replace: 置換
$result = preg_replace('/\s+/', ' ', 'hello   world'); // 'hello world'

// preg_match_all: 全マッチを取得
preg_match_all('/\d+/', 'abc123def456', $matches);
// $matches[0] = ['123', '456']
```

---

## 実習

`exercises.php` を開いて `TODO(human)` を実装してください。

```bash
php exercises.php
```

---

## 参考ドキュメント

- PHP preg_match(): https://www.php.net/manual/ja/function.preg-match.php
- PHP preg_replace(): https://www.php.net/manual/ja/function.preg-replace.php
- PHP preg_match_all(): https://www.php.net/manual/ja/function.preg-match-all.php
- PHP PCRE パターン構文: https://www.php.net/manual/ja/reference.pcre.pattern.syntax.php
- regex101（正規表現デバッガー）: https://regex101.com/（言語を PHP に設定して使う）

---

## 理解の確認

自分で選んだ任意のバリデーション（郵便番号・電話番号など）に対して、
正規表現パターンを1から書いて、マッチする例・しない例で動作確認してください。
