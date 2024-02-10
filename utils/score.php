<?php
class Score {
    public $fileChecksum;
    public $Username;
    public $onlinescoreChecksum;
    public $count300;
    public $count100;
    public $count50;
    public $countGeki;
    public $countKatu;
    public $countMiss;
    public $totalScore;
    public $maxCombo;
    public $perfect;
    public $ranking;
    public $enabledMods;
    public $pass;
    public function __construct(
        $fileChecksum,
        $Username,
        $onlinescoreChecksum,
        $count300,
        $count100,
        $count50,
        $countGeki,
        $countKatu,
        $countMiss,
        $totalScore,
        $maxCombo,
        $perfect,
        $ranking,
        $enabledMods,
        $pass
    ){
        $this->fileChecksum = $fileChecksum;
        $this->Username = $Username;
        $this->onlinescoreChecksum = $onlinescoreChecksum;
        $this->count300 = $count300;
        $this->count100 = $count100;
        $this->count50 = $count50;
        $this->countGeki = $countGeki;
        $this->countKatu = $countKatu;
        $this->countMiss = $countMiss;
        $this->totalScore = $totalScore;
        $this->maxCombo = $maxCombo;
        $this->perfect = $perfect;
        $this->ranking = $ranking;
        $this->enabledMods = $enabledMods;
        $this->pass = $pass;
    }
    
}

