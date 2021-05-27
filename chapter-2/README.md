- 変更を厄介にするのは条件分岐
    - 問題例
        - 地域によって送料が変動する。また地域と製品タイプによって価格が変動する -> 組み合わせがかなり有るので追うのが大変
    - 非推奨な書き方
        1. 判断や加工のロジックをそのままif文にかく
    - 対処法
        1. メソッドに抽出する

### 感想
- メソッド名が変数名のような命名で驚いた。（例：価格計算処理 → 僕：`calcPrice()`, 書籍：`fee()`）
- 状態が遷移するような処理は対応表を作成して可視化する
- ENUMにはphp-enumを使用した

### 疑問

Q. FeeクラスにcustomerTypeを持たせるのとは何が違う？ <br>
A. 独立性を高めるためにクラスを分ている。分ないとロジックが増えたときにFeeクラスが肥大化する


### 参考
- [Enumの必要性](https://speakerdeck.com/takayukifujisawa/nazephpnihaenumganaifalseka?slide=6)
- [php-enum](https://packagist.org/packages/myclabs/php-enum)