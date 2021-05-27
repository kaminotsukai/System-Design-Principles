<?php

class Fee
{
    private string $customerType;
    private int $baseFee;

    public function __construct(
        string $customerType,
        int $baseFee
    ) {
        $this->customerType = $customerType;
        $this->baseFee      = $baseFee;
    }

    // ================================================
    // 問題例１：判断や加工のロジックをそのままif文にかく（-> メソッドの抽出）
    // メリット：可読性は上がる
    // 疑問　　：一つのクラスに大量の条件分岐メソッドが入るのも可読性が下がる？
    // ================================================
    private function fee_step1()
    {
        $fee = 0;

        if ($this->customerType === 'child') {
            $fee = $this->baseFee * 0.5;
        }

        return $fee;
    }

    // ================================================
    // 問題例２：else文をかく（-> 早期リターンのすすめ）
    // メリット：可読性が上がる
    // 感想　　：全てに置いてelseを消せばいいというわけではない気がする
    // ================================================
    private function fee_step2()
    {
        $result = 0;

        if ($this->isChild()) {
            $result = $this->childFee();
        } else if ($this->isSenior()) {
            $result = $this->seniorFee();
        } else {
            $result = $this->baseFee;
        }

        return $result;
    }

    // 理想
    public function fee()
    {
        if ($this->isChild()) return $this->childFee();
        if ($this->isSenior()) return $this->seniorFee();
        return $this->baseFee;
    }

    private function isChild(): bool
    {
        return $this->customerType === 'child';
    }

    private function isSenior(): bool
    {
        return $this->customerType === 'senior';
    }

    private function childFee(): int
    {
        return $this->baseFee * 0.5;
    }

    private function seniorFee(): int
    {
        return $this->baseFee * 0.8;
    }
}


$fee = new Fee('child', 500);
echo $fee->fee();