<?php

declare(strict_types=1);

use Application\Src\Model\Encounter\Encounter;
use Application\Src\Model\Player\Player;

require_once('src/models/Encounter.php');
require_once('src/models/Player.php');

$greg = new Player;
$greg->setLevel(400);
$jade = new Player;
$jade->setLevel(800);

echo sprintf(
    'Greg à %.2f%% chance de gagner face a Jade',
    Encounter::probabilityAgainst($greg, $jade) * 100

) . PHP_EOL;

// Imaginons que greg l'emporte tout de même.
Encounter::setNewLevel($greg, $jade, Encounter::RESULT_WINNER);
Encounter::setNewLevel($jade, $greg, Encounter::RESULT_LOSER);

echo sprintf(
    'les niveaux des joueurs ont évolués vers %s pour Greg et %s pour Jade',
    $greg->getLevel(),
    $jade->getLevel()
);

exit(0);
