#!/bin/bash

echo "=== エンコード/デコード練習 ==="
echo ""

# --- base64 ---
echo "--- base64 ---"
ENCODED_B64="aGVsbG8gd29ybGQ="

# TODO(human): base64 デコードするコマンドを書く
# echo "$ENCODED_B64" | ???
echo "base64: (TODO)"
echo ""

# --- hex ---
echo "--- hex (16進数) ---"
ENCODED_HEX="68 65 6c 6c 6f 20 77 6f 72 6c 64"

# TODO(human): hex デコードするコマンドを書く（xxd -r -p を使う）
# echo "$ENCODED_HEX" | ???
echo "hex: (TODO)"
echo ""

# --- ROT13 ---
echo "--- ROT13 ---"
ENCODED_ROT13="uryyb jbeyq"

# TODO(human): ROT13 デコードするコマンドを書く（tr コマンドを使う）
# echo "$ENCODED_ROT13" | ???
echo "ROT13: (TODO)"
echo ""

# --- URL encode ---
echo "--- URL encode ---"
ENCODED_URL="%68%65%6c%6c%6f%20%77%6f%72%6c%64"

# TODO(human): URL デコードするコマンドを書く（python3 を使う）
# python3 -c "import urllib.parse; print(urllib.parse.unquote('$ENCODED_URL'))"
echo "URL encode: (TODO)"
echo ""

# --- base32 ---
echo "--- base32 ---"
ENCODED_B32="NBSWY3DPEB3W64TMMQ======"

# TODO(human): base32 デコードするコマンドを書く（python3 を使う）
# python3 -c "import base64; print(base64.b32decode('$ENCODED_B32').decode())"
echo "base32: (TODO)"
echo ""


echo "=== チャレンジ問題 ==="
echo "以下を全部デコードして、同じ文字列が書いてあることを確認してください"
echo ""

CHALLENGE_1="SGVsbG8gV29ybGQ="
CHALLENGE_2="JBSWY3DPEB3W64TMMQ======"
CHALLENGE_3="48656c6c6f20576f726c64"
CHALLENGE_4="%48%65%6c%6c%6f%20%57%6f%72%6c%64"
CHALLENGE_5="Uryyb Jbeyq"

echo "1: $CHALLENGE_1"
echo "2: $CHALLENGE_2"
echo "3: $CHALLENGE_3"
echo "4: $CHALLENGE_4"
echo "5: $CHALLENGE_5"
echo ""

# TODO(human): 5つ全部デコードしてそれぞれ出力する
