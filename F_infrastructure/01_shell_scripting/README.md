# F-1: シェルスクリプト基礎

## 目的

変数・if 文・for ループ・関数を使ったシェルスクリプトを書けるようにする。

---

## 事前に考えてみよう

毎日手動でやっている作業（ログファイルの確認・バックアップ・デプロイ手順など）をシェルスクリプトで自動化するとしたら、どんな処理が必要か想像してみてください。

---

## 背景知識

```bash
#!/bin/bash

# 変数（スペースを入れない）
NAME="World"
echo "Hello, $NAME"

# if 文
FILE="test.txt"
if [ -f "$FILE" ]; then
    echo "ファイルが存在する"
elif [ -d "$FILE" ]; then
    echo "ディレクトリが存在する"
else
    echo "存在しない"
fi

# for ループ
for i in 1 2 3 4 5; do
    echo "i = $i"
done

# コマンドの出力を変数に代入
DATE=$(date '+%Y-%m-%d')
echo "今日は $DATE"

# 関数
greet() {
    local name=$1  # 第1引数
    echo "Hello, $name!"
}
greet "Alice"

# 終了コード（0 = 成功、0以外 = 失敗）
ls /nonexistent 2>/dev/null
if [ $? -ne 0 ]; then
    echo "失敗した"
fi
```

よく使う条件:
| 条件 | 意味 |
|------|------|
| `-f FILE` | ファイルが存在する |
| `-d DIR` | ディレクトリが存在する |
| `-e PATH` | パスが存在する（ファイル・ディレクトリ問わず）|
| `-z STRING` | 文字列が空 |
| `-n STRING` | 文字列が空でない |
| `A -eq B` | 数値が等しい |
| `A -gt B` | A > B |

---

## 実習

`starter.sh` を開いて `TODO(human)` を実装してください。

```bash
chmod +x starter.sh
./starter.sh
```

---

## 参考ドキュメント

- GNU Bash マニュアル: https://www.gnu.org/software/bash/manual/bash.html
- Bash 条件式: https://www.gnu.org/software/bash/manual/bash.html#Bash-Conditional-Expressions
- ShellCheck（シェルスクリプトの静的解析）: https://www.shellcheck.net/
- explainshell（コマンドを解説してくれるサービス）: https://explainshell.com/

---

## 理解の確認

`2>/dev/null` と `>/dev/null 2>&1` の違いを説明してください。
（ヒント: 標準出力と標準エラー出力の違い）
