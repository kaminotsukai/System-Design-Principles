<?php


/**
 * 【プログラムの変更を楽にする書き方】
 *  プログラムの変更が楽になる書き方
 *  小さなクラスでわかりやすく安全に
 *
 * 1. わかりやすい名前を使う
 *  - 業務で使用している言葉をそのままコードに反映する
 *  - 省略しない
 *
 * 2. 長いメソッドは段落に分けて読みやすくする
 *
 * 3. 目的毎に変数を用意する
 *  - 段落毎に説明用の変数を導入
 *  - 破壊的代入は副作用の元凶
 *
 * 4. 段落をメソッドとして独立させる = メソッドの抽出
 *  - 元のコードがシンプルになり読みやすくなる
 *  - メソッドの名前からコードの糸を理解しやすくなる
 *  - メソッド内に変更の影響を閉じ込めやすくなる
 *  - 再利用性が高まる（メソッド化していないと同じ処理があちこちに書かれる）
 */


/**
 * わかりにくいコード
 */
function calc($qty, $up)
{
    $price = $qty * $up;
    if ($price < 3000) {
        $price += 500;
    }
    $price = $price * taxRate();
}

/**
 * わかりやすい名前を使う
 */
function calc_1($quantity, $unitPrice)
{
    $price = $quantity * $unitPrice;
    if ($price < 3000) {
        $price += 500;
    }
    $price = $price * taxRate();
}


/**
 * 長いメソッドは段落に分けて読みやすくする
 */
function calc_2($quantity, $unitPrice)
{
    $price = $quantity * $unitPrice;

    if ($price < 3000) {
        $price += 500;
    }

    $price = $price * taxRate();
}


/**
 * 目的毎に変数を用意する
 *
 * 価格を以下の3つに分類
 *  - 基本価格
 *  - 送料
 *  - 税込金額
 */
function calc_3($quantity, $unitPrice)
{
    $basePrice = $quantity * $unitPrice;
    $shippingCost = 0;

    if ($basePrice < 3000) {
        $shippingCost += 500;
    }

    $itemPrice = ($basePrice + $shippingCost) * taxRate();
}

/**
 * 段落をメソッドとして独立させる
 */
function calc_4($quantity, $unitPrice)
{
    $basePrice = $quantity * $unitPrice;

    $shippingCost = shippingCost($basePrice);

    $itemPrice = ($basePrice + $shippingCost) * taxRate();
}

function shippingCost($basePrice)
{
    if ($basePrice < 3000) return 500;
    return 0;
}


function taxRate()
{
    return 1.08;
}

/**
 * クラスとして分離する
 */
class shippingCost
{
    const MINIMUM_FOR_FREE = 3000;
    const COST = 500;

    public $basePrice;

    public function __construct($basePrice)
    {
        $this->basePrice = $basePrice;
    }

    public function ammount()
    {
        if ($this->basePrice < self::MINIMUM_FOR_FREE) return self::COST;
        return 0;
    }
}