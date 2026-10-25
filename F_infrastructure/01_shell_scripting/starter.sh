#!/bin/bash

# シェルスクリプト練習


# --- Step 1: 変数と引数 ---

echo "=== Step 1: 変数と引数 ==="

# TODO(human): スクリプトの第1引数を NAME に代入し、
#              引数がなければ "Guest" をデフォルト値にして
#              "Hello, {NAME}!" と表示する
# ヒント: ${1:-"Guest"} でデフォルト値を設定できる

# TODO(human)
echo ""


# --- Step 2: ファイル・ディレクトリの確認 ---

echo "=== Step 2: ファイル確認 ==="

# TODO(human): 引数で受け取ったパスが
#              - ファイルなら "ファイルです: {パス}"
#              - ディレクトリなら "ディレクトリです: {パス}"
#              - 存在しないなら "存在しません: {パス}" と表示する関数を書く

check_path() {
    local path=$1
    # TODO(human)
}

check_path "."
check_path "$0"
check_path "/nonexistent/path"
echo ""


# --- Step 3: ループとファイル操作 ---

echo "=== Step 3: PHP ファイルを探す ==="

# TODO(human): カレントディレクトリ以下にある .php ファイルを全て表示する
#              find コマンドと for ループを組み合わせる
#              ファイルが見つかるたびに "見つかった: {ファイルパス}" と表示する

# TODO(human)
echo ""


# --- Step 4: ログ解析 ---

echo "=== Step 4: ログ解析 ==="

# テスト用のログファイルを作る
cat > /tmp/test_app.log << 'EOF'
2024-03-01 10:00:01 INFO  アプリが起動しました
2024-03-01 10:01:15 INFO  ユーザー Alice がログインしました
2024-03-01 10:02:30 ERROR DBへの接続に失敗しました
2024-03-01 10:03:45 INFO  リトライ中...
2024-03-01 10:04:00 INFO  DB接続成功
2024-03-01 10:05:10 ERROR タイムアウトが発生しました
2024-03-01 10:06:20 WARN  メモリ使用率が80%を超えました
2024-03-01 10:07:30 ERROR ディスク容量不足
EOF

# TODO(human): /tmp/test_app.log から ERROR が含まれる行だけ表示する
echo "--- ERROR ログ ---"
# TODO(human)

# TODO(human): ERROR の件数を数えて表示する
echo "--- ERROR 件数 ---"
# TODO(human)

echo ""


# --- Step 5: 関数とリターンコード ---

echo "=== Step 5: バックアップ関数 ==="

# TODO(human): 引数でファイルパスを受け取り、
#              "{ファイル名}.bak.{日付}" という名前でコピーする関数を書く
#              ファイルが存在しなければエラーメッセージを出して 1 を返す
#              成功したら "バックアップ作成: {バックアップパス}" と表示して 0 を返す

backup_file() {
    local source=$1
    # TODO(human)
}

touch /tmp/test_target.txt
backup_file "/tmp/test_target.txt"
backup_file "/tmp/nonexistent.txt"
