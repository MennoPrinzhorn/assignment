<?php
declare(strict_types=1);
require('models/User.php');
require('models/Board.php');
require('Helpers/TilesGenerator.php');
require('models/Tile.php');

$tileGenerator = new TilesGenerator();
$userOne = new User('Alice');
$userTwo = new User('Bob');

$board = new Board();
$board->addUsers($userOne, $userTwo);
$board->setStock($tileGenerator->generate());
$board->divideTiles(7);
$board->play();