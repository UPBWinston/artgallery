<?php

namespace App\Util;

class Food
{

    private string $name;
    private int $phValue;


    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }


    public function getPhValue(): int
    {
        return $this->phValue;
    }

    public function setPhValue(int $phValue): void
    {
        $this->phValue = $phValue;
    }

    public function isAcidic():bool{
        return $this->phValue < 7;
    }

    public function isAcidicString():string{
        if ($this->isAcidic()){
            return "acidic";
        }
        else{
            return "not acidic";
        }
    }
}