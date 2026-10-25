# エンジニアスキル強化ワークショップ

QAエンジニアとして働きながら、開発・ネットワーク・CTF・自動テストの力を伸ばすためのワークショップ集。

## 使い方

1. 各ディレクトリの `README.md` を開く
2. 「事前に考えてみよう」の問いに自分なりの答えを出してから先を読む
3. `TODO(human)` のマーカーがある箇所を自分で実装する
4. 終わったら「自分の言葉で説明できるか」を確認する
5. 詰まったら Claude Code に「workshop/○○ の TODO(human) で詰まった」と伝える

## 推奨着手順

```
【今すぐ】誤り修正（00_fix_misunderstandings）
  01_chmod
  02_array_functions
  03_group_by_having
  04_rest_api_design
  05_password_hash

【次】実務直結
  A_sql/01_joins
  B_php_oop/01_interface_abstract
  D_http_api/01_status_codes
  G_testing/01_test_design

【CTF 強化】
  E_security_ctf/01_idor
  E_security_ctf/02_lfi
  E_security_ctf/03_encoding

【設計力強化】
  B_php_oop/02_dependency_injection
  B_php_oop/03_error_exception
  D_http_api/02_jwt

【インフラ基礎】
  F_infrastructure/01_shell_scripting
  F_infrastructure/02_env_variables
  F_infrastructure/03_redis
```

## ルール

- 答えを先に求めない。「なぜそうなるのか」を優先する
- コードは必ず手を動かして書く。読むだけでは身につかない
- 課題が終わったら自分の言葉で説明できるか確認してから次へ進む
