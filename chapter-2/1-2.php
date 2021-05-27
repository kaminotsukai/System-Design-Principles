<?php

// ================================================
// 推奨　　　：区分ごとのロジックを別クラスに分けて、クラスを同じ型として扱う
// メリット　：同じ型として扱うため、場合分けを排除できる
// 疑問　　　：FeeクラスにcustomerTypeを持たせるのとは何が違う？
// 残る問題点：Feeクラスを作成する際に場合わけが必要
// ================================================

interface Fee
{
    public function fee(): int;
    public function label(): string;
}


class AdultFee implements Fee
{
    public function fee(): int
    {
        return 100;
    }

    public function label(): string
    {
        return '大人';
    }
}

class ChildFee implements Fee
{
    public function fee(): int
    {
        return 50;
    }

    public function label(): string
    {
        return '子供';
    }
}

class SeniorFee implements Fee
{
    public function fee(): int
    {
        return 80;
    }

    public function label(): string
    {
        return 'シニア';
    }
}

class Reservation
{
    private array $fees;

    public function __construct()
    {
        $this->fees = [];
    }

    public function addFee(Fee $fee): void
    {
        $this->fees[] = $fee;
    }

    public function feeTotal(): int
    {
        $total = 0;
        foreach ($this->fees as $fee) {
            $total += $fee->fee();
        }
        return $total;
    }
}


// ================================================
// 推奨　　　：区分ごとのインスタンスを作成してくれるFactoryを作成する
// 残る問題点：PHPではstatic変数を初期化する方法が用意されていない（どうしようもない）
// ================================================

class FeeFactory
{
    private static $types;

    public static function initialize()
    {
        self::$types = [
            'adult' => new AdultFee(),
            'child' => new ChildFee()
        ];
    }

    public static function feeByName(string $name)
    {
        return self::$types->get($name);
    }
}