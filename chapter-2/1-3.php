<?php

use MyCLabs\Enum\Enum;

require_once "vendor/autoload.php";

// ================================================
// 推奨　　　：業務の状態遷移フローを書いてみる（https://qiita.com/ma91n/items/fb7ad9dfb7430dd08455）
// メリット　：業務ルールを可視化できる
//
// 以下のような対応表をかくと便利
// ---------------------------------
// from/to | 審査中 | 承認済 | 差戻中 |
// 審査中   |   -   |　承認  |　差戻  |
// 承認済   |   -   |   -   |   -   |
// 差戻中   | 再申請 |   -   |   -   |
// ================================================

final class State extends Enum
{
    private const UNDER_REVIEW = '審査中';
    private const REMAND = '差し戻し中';
    private const APPROVED = '承認済';
}

class StateTransitions
{
    /**
     * @var array[State]
     */
    private array $allowed = [
        '審査中' => ['承認済', '差し戻し中'],
        '差し戻し中' => ['審査中', '終了'],
    ];

    public function canTransit(State $from, State $to): bool
    {
        $allowedStates = $this->allowed->get();
        return false;
    }
}

echo State::UNDER_REVIEW();