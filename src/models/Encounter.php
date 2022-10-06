<?php

declare(strict_types=1);

namespace Application\Src\Model\Encounter;

use Application\Src\Model\Player\Player;

class Encounter
{
    public const RESULT_WINNER = 1;
    public const RESULT_LOSER = -1;
    public const RESULT_DRAW = 0;
    private const RESULT_POSSIBILITIES = [Encounter::RESULT_WINNER, Encounter::RESULT_LOSER, Encounter::RESULT_DRAW];

    public static function probabilityAgainst(Player $playerOne, Player $adversePlayer): float
    {
        return 1 / (1 + (10 ** (($adversePlayer->getLevel() - $playerOne->getLevel()) / 400)));
    }

    public static function setNewLevel(Player $playerOne, Player $adversePlayer, int $playerResult)
    {
        if (!in_array($playerResult, Encounter::RESULT_POSSIBILITIES)) {
            trigger_error(sprintf('Invalid result. Expected %s', implode(' or ', Encounter::RESULT_POSSIBILITIES)));
        }

        $playerOne->setLevel($playerOne->getLevel() + (int) (32 * ($playerResult - Encounter::probabilityAgainst($playerOne, $adversePlayer))));
    }
}
