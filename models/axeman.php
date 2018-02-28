<?php

class Axeman extends Warrior {
    public $AxeSize;

    public function __construct() {
    	if (func_num_args() > 0) {
            $_id     = func_get_arg(0);
            $_name   = func_get_arg(1);
            $_damage = func_get_arg(2);
            $_life   = func_get_arg(3);
            $_level  = func_get_arg(4);
            parent::__construct($_id, $_name, $_damage, $_life, $_level);
      		$this->AxeSize = func_get_arg(5);
    	}
  	}

    public function attack() {
        echo ucfirst($this->Name) . " attacks with $this->AxeSize axe, damage: $this->Damage";
        $this->Life -= $this->Level;
    }
    
    public function upgradeLevel() {
        $this->Level++;
        $this->Damage *= $this->Level;
        if ($this->Level > 3) {
            $this->AxeSize = "medium";
            if ($this->Level > 5) {
                $this->AxeSize = "big";
            }
        }
    }
    
    public function updateWarrior($conn) {
        $sql = "UPDATE axeman
        SET Damage = $this->Damage, Life = $this->Life, level = $this->Level, AxeSize = '$this->AxeSize'
        WHERE Id = $this->Id";
        $conn->connectData($sql);
    }

    public function saveWarrior($conn) {
        $sql = "INSERT INTO axeman (Name, Damage, Life, Level, AxeSize) 
        VALUES ('$this->Name', $this->Damage, $this->Life, $this->Level, '$this->AxeSize')";
        $conn->connectData($sql);
        return "Axeman warrior added to yor battle war";
    }
}

?>
