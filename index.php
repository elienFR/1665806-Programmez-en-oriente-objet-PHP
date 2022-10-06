<?php

use Application\Src\Model\Encounter\Encounter;

$greg = new Encounter();
$greg->level = 400;
$jade = new Encounter();
$jade->level = 800;


echo sprintf(
    'Greg à %.2f%% chance de gagner face a Jade',
    $greg->probabilityAgainst($jade) * 100
    
) . PHP_EOL;

// Imaginons que greg l'emporte tout de même.
$greg->setNewLevel($jade, $greg->RESULT_WINNER);
$jade->setNewLevel($greg, $jade->RESULT_LOSER);

echo sprintf(
    'les niveaux des joueurs ont évolués vers %s pour Greg et %s pour Jade',
    $greg->level,
    $jade->level
);

exit(0);
