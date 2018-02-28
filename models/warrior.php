<?php

abstract class Warrior {
    protected $Id;
    protected $Name;
    public $Damage;
    public $Life;
    public $Level;
    
    public function __construct($_id, $_name, $_damage, $_life, $_level) {
        $this->Id     = $_id;
        $this->Name   = $_name;
        $this->Damage = $_damage;
        $this->Life   = $_life;
        $this->Level  = $_level;
    }

    public function getId() {
        return $this->Id;
    }

    public function getName() {
        return $this->Name;
    }
       
    abstract public function upgradeLevel();
}

?>
