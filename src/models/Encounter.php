<?php

declare(strict_types=1);

namespace Application\Src\Model\Encounter;
use Application\Src\Model\Player\Player;

class Encounter
{
   
    public const RESULT_WINNER = 1;
    public const RESULT_LOSER = -1;
    public const RESULT_DRAW = 0;
    public const RESULT_POSSIBILITIES = [Encounter::RESULT_WINNER, Encounter::RESULT_LOSER, Encounter::RESULT_DRAW];

    public int $result;

    public function probabilityAgainst(Player $playerOne, Player $adversePlayer): float
    {
        return 1 / (1 + (10 ** (($adversePlayer->level - $playerOne->level) / 400)));
    }

    public function setNewLevel(Player $playerOne, Player $adversePlayer, int $playerResult)
    {
        if (!in_array($playerResult, $this::RESULT_POSSIBILITIES)) {
            trigger_error(sprintf('Invalid result. Expected %s', implode(' or ', $this::RESULT_POSSIBILITIES)));
        }

        $playerOne->level += (int) (32 * ($playerResult - $this->probabilityAgainst($playerOne, $adversePlayer)));
    }
}
