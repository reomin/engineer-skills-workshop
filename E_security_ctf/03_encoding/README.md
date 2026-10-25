# E-3: エンコード系 CTF

## 目的

base64 以外のエンコード方式（hex・ROT13・URLエンコード・base32）をコマンドラインでデコードできるようにし、CTF で「これは何でエンコードされているか」を素早く見抜けるようにする。

---

## 事前に考えてみよう

`68656c6c6f` という文字列を見て、何でエンコードされているか分かりますか？
（ヒント: 2文字ずつ区切ってみる）

---

## 背景知識

CTF でよく見るエンコード:

| 種類 | 特徴 | 例 |
|------|------|----|
| base64 | `=` でパディング、英数字 + `+/` | `aGVsbG8=` |
| base32 | `=` でパディング、大文字英字 + 数字 `2-7` | `NBSWY3DP` |
| hex | 0-9, a-f の2文字ペア | `68656c6c6f` |
| ROT13 | アルファベットを13文字ずらす | `uryyb` |
| URL encode | `%XX` の形式 | `%68%65%6c%6c%6f` |

見分け方のヒント:
- `=` が末尾にある → base64 か base32
- `2-7` の大文字のみ → base32
- 16進数2文字のペア → hex
- `%XX` パターン → URL エンコード
- 文字の頻度が英語に近いが少しずれている → ROT13 やシーザー暗号

---

## 実習

`decode.sh` を開いて `TODO(human)` を完成させてください。

```bash
chmod +x decode.sh
./decode.sh
```

---

## 参考ドキュメント

- RFC 4648（base64 / base32 仕様）: https://www.rfc-editor.org/rfc/rfc4648
- MDN base64 のエンコード・デコード: https://developer.mozilla.org/ja/docs/Glossary/Base64
- CyberChef（オールインワンエンコードツール）: https://gchq.github.io/CyberChef/
- Python base64 モジュール: https://docs.python.org/ja/3/library/base64.html

---

## 理解の確認

CTF で以下の文字列を見たとき、まず何を疑いますか？

1. `SGVsbG8gV29ybGQ=`
2. `JBSWY3DPEB3W64TMMQ======`
3. `2f6574632f706173737764`
4. `%2F%65%74%63%2F%70%61%73%73%77%64`
5. `Uryyb Jbeyq`

（それぞれ同じ文字列のエンコードです。何が書いてあるか全部デコードして確認してみてください）
