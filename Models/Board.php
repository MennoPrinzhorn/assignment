<?php

class Board
{
    private $stock = [];
    private $userOne;
    private $userTwo;
    private $tiles;
    private $endOfGame = false;

    public function addUsers(User $userOne, User $userTwo): void {
        $this->userOne = $userOne;
        $this->userTwo = $userTwo;
    }

    public function setStock(array $tiles): void {
        $this->stock = $tiles;
    }

    public function getStock(): array {
        return $this->stock;
    }

    public function addTile(Tile $tile): void {
        $this->tiles[] = $tile;
    }

    public function divideTiles(int $amount): void {
        $total_tiles = $amount * 2;
        if($total_tiles > count($this->stock)) {
            throw new Exception('Not enough tiles to divide');
        }

        for ($i=1;$i <= $amount;$i++) {
            $tile = array_pop($this->stock);
            $this->userOne->addTile($tile);

            $tile = array_pop($this->stock);
            $this->userTwo->addTile($tile);
        }
    }

    public function play(): void {
        $this->setStartTile();
        echo 'Game starting with first tile: <'. $this->tiles[0]->getSquareOne().':'.$this->tiles[0]->getSquareTwo().'><br>';

        while($this->endOfGame === false) {
            $this->userLoop($this->userOne);
            if($this->endOfGame === false) {
                $this->userLoop($this->userTwo);
            }

        }
    }

    private function userLoop($user): void
    {
        $tile = $this->getLastTileFromBoard();

        $userTile = null;
        while($userTile === null) {
            $userTile = $user->searchTile($tile->getSquareTwo());

            if($userTile === null) {
                if(count($this->stock) === 0) {
                    //There are no dominos left. (choose winner)
                    echo $this->userOne->getName(). " has a total of ". $this->userOne->amountOfTiles(). " tiles<br>";
                    echo $this->userTwo->getName(). " has a total of ". $this->userTwo->amountOfTiles(). " tiles<br>";

                    if ($this->userOne->amountOfTiles() > $this->userTwo->amountOfTiles()){
                        echo 'Player '. $this->userTwo->getName(). ' Has won!';
                    }else if ($this->userOne->amountOfTiles() === $this->userTwo->amountOfTiles()) {
                        echo 'Both players have to same amount of tiles left... Its a draw!';
                    } else {
                        echo 'Player '. $this->userOne->getName(). ' Has won!';
                    }
                    $this->endOfGame = true;
                    break;
                }
                $newTile = array_pop($this->stock);
                $user->addTile($newTile);
            }
        }

        if ($userTile !== null){
            $this->addTile($userTile);
            echo $user->getName().' plays <'.$userTile->getSquareOne().':'.$userTile->getSquareTwo().'> to connect to tile <'.$tile->getSquareOne().':'.$tile->getSquareTwo().'> on the board<br>';
            echo 'Board is now: ';
            foreach($this->tiles as $tile)
            {
                echo '<'. $tile->getSquareOne(). ':'. $tile->getSquareTwo().'> ';
            }
            echo '<br>';
        }
    }

    private function setStartTile(): void {
        $randomIndex = array_rand($this->stock);
        $this->tiles[] = $this->stock[$randomIndex];
        unset($this->stock[$randomIndex]);
    }

    private function getLastTileFromBoard(): Tile {
        return end($this->tiles);
    }
}