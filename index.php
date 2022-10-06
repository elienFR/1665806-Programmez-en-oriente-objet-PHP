<?php

use Application\Src\Model\Encounter\Encounter;
use Application\Src\Model\Player\Player;

$greg = new Player;
$greg->level = 400;
$jade = new Player;
$jade->level = 800;

$encounter = new Encounter;


echo sprintf(
    'Greg à %.2f%% chance de gagner face a Jade',
    $encounter->probabilityAgainst($greg, $jade) * 100

) . PHP_EOL;

// Imaginons que greg l'emporte tout de même.
$encounter->setNewLevel($greg, $jade, $encounter::RESULT_WINNER);
$encounter->setNewLevel($jade, $greg, $encounter::RESULT_LOSER);

echo sprintf(
    'les niveaux des joueurs ont évolués vers %s pour Greg et %s pour Jade',
    $greg->level,
    $jade->level
);

exit(0);
