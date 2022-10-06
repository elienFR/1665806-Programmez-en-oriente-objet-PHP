<?php

namespace Application\Src\Model\Encounter;

class Encounter
{
   
    public const RESULT_WINNER = 1;
    public const RESULT_LOSER = -1;
    public const RESULT_DRAW = 0;
    public const RESULT_POSSIBILITIES = [0, -1, 1];


    public int $level;
    public int $result;

    public function probabilityAgainst(Encounter $playerTwo): float
    {
        return 1 / (1 + (10 ** (($playerTwo->level - $this->level) / 400)));
    }

    public function setNewLevel(Encounter $adversePlayer, int $playerResult)
    {
        if (!in_array($this->result, $this->RESULT_POSSIBILITIES)) {
            trigger_error(sprintf('Invalid result. Expected %s', implode(' or ', $this->RESULT_POSSIBILITIES)));
        }

        $this->level += (int) (32 * ($playerResult - $this->probabilityAgainst($adversePlayer)));
    }
}
