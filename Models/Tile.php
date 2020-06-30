<?php
/**
 * Created by PhpStorm.
 * User: menza
 * Date: 29/06/2020
 * Time: 15:02
 */

class Tile
{
    private $squareOne;
    private $squareTwo;

    public function setSquareOne(int $squareOne): void {
        $this->squareOne = $squareOne;
    }

    public function setSquareTwo(int $squareTwo): void {
        $this->squareTwo = $squareTwo;
    }

    public function getSquareOne(): int {
        return $this->squareOne;
    }

    public function getSquareTwo(): int {
        return $this->squareTwo;
    }

    public function switchSquares(): void {
        $squareOne = $this->squareOne;
        $squareTwo = $this->squareTwo;

        $this->squareOne = $squareTwo;
        $this->squareTwo = $squareOne;
    }
}