<?php

class User
{
    private $name;
    private $tiles;

    public function __construct(string $name, array $tiles = null)
    {
        $this->name = $name;
        $this->tiles = $tiles;
    }

    public function getName(): string {
        return $this->name;
    }

    public function addTile(Tile $tile): void {
        $this->tiles[] = $tile;
    }

    public function hasTiles(): bool {
        return count($this->tiles);
    }

    public function amountOfTiles(): int {
        return count($this->tiles);
    }

    public function searchTile(int $number): ?Tile {
        for ($i = 0;$i <= count($this->tiles) -1;$i++) {
            if($this->tiles[$i]->getSquareOne() === $number) {
                return $this->getTileAndResetArray($i);
            }

            if($this->tiles[$i]->getSquareTwo() === $number) {
                $tile = $this->getTileAndResetArray($i);
                $tile->switchSquares();
                return $tile;

            }
        }
        return null;
    }

    public function getTiles(): array {
        return $this->tiles;
    }

    private function getTileAndResetArray($i): tile {
        $tile = $this->tiles[$i];
        unset($this->tiles[$i]);
        $this->tiles = array_values($this->tiles);
        return $tile;
    }
}