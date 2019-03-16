<?php

namespace App\Entity;

class Cardsearch {

    private $minAtk;

    private $maxAtk;

    private $minDef;

    private $maxDef;

    private $minLevel;

    private $maxLevel;

    /**
     * @return mixed
     */
    public function getMinAtk()
    {
        return $this->minAtk;
    }

    /**
     * @param mixed $minAtk
     */
    public function setMinAtk($minAtk): void
    {
        $this->minAtk = $minAtk;
    }

    /**
     * @return mixed
     */
    public function getMaxAtk()
    {
        return $this->maxAtk;
    }

    /**
     * @param mixed $maxAtk
     */
    public function setMaxAtk($maxAtk): void
    {
        $this->maxAtk = $maxAtk;
    }

    /**
     * @return mixed
     */
    public function getMinDef()
    {
        return $this->minDef;
    }

    /**
     * @param mixed $minDef
     */
    public function setMinDef($minDef): void
    {
        $this->minDef = $minDef;
    }

    /**
     * @return mixed
     */
    public function getMaxDef()
    {
        return $this->maxDef;
    }

    /**
     * @param mixed $maxDef
     */
    public function setMaxDef($maxDef): void
    {
        $this->maxDef = $maxDef;
    }

    /**
     * @return mixed
     */
    public function getMinLevel()
    {
        return $this->minLevel;
    }

    /**
     * @param mixed $minLevel
     */
    public function setMinLevel($minLevel): void
    {
        $this->minLevel = $minLevel;
    }

    /**
     * @return mixed
     */
    public function getMaxLevel()
    {
        return $this->maxLevel;
    }

    /**
     * @param mixed $maxLevel
     */
    public function setMaxLevel($maxLevel): void
    {
        $this->maxLevel = $maxLevel;
    }
}