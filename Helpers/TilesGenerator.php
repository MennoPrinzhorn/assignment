<?php

class TilesGenerator
{
    public function generate(): array
    {
        $tileArray = [];

        for($i = 0; $i <= 6;$i++)
        {
            for($j = 0; $j <= $i;$j++) {
                $tile = new Tile();
                $tile->setSquareOne($j);
                $tile->setSquareTwo($i);
                $tileArray[] = $tile;
            }
        }

        shuffle($tileArray);
        return $tileArray;
    }
}