<?php

declare(strict_types=1);

namespace Application\Src\Model\Encounter;

use Application\Src\Model\Player\Player;

class Encounter
{
    public const RESULT_WINNER = 1;
    public const RESULT_LOSER = -1;
    public const RESULT_DRAW = 0;
    private const RESULT_POSSIBILITIES = [self::RESULT_WINNER, self::RESULT_LOSER, self::RESULT_DRAW];

    public static function probabilityAgainst(Player $playerOne, Player $adversePlayer): float
    {
        return 1 / (1 + (10 ** (($adversePlayer->getLevel() - $playerOne->getLevel()) / 400)));
    }

    public static function setNewLevel(Player $playerOne, Player $adversePlayer, int $playerResult)
    {
        if (!in_array($playerResult, self::RESULT_POSSIBILITIES)) {
            trigger_error(sprintf('Invalid result. Expected %s', implode(' or ', self::RESULT_POSSIBILITIES)));
        }

        $playerOne->setLevel($playerOne->getLevel() + (int) (32 * ($playerResult - self::probabilityAgainst($playerOne, $adversePlayer))));
    }
}
