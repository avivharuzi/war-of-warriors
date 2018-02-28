<?php

class Swordsman extends Warrior {
    public $SwordLength;
    
    public function __construct() {
    	if (func_num_args() > 0) {
            $_id     = func_get_arg(0);
            $_name   = func_get_arg(1);
            $_damage = func_get_arg(2);
            $_life   = func_get_arg(3);
            $_level  = func_get_arg(4);
            parent::__construct($_id, $_name, $_damage, $_life, $_level);
      		$this->SwordLength = func_get_arg(5);
    	}
  	}

    public function attack() {
        echo ucfirst($this->Name) . " attacks with $this->SwordLength sword, damage: $this->Damage";
        $this->Life -= $this->Level;
    }
    
    public function upgradeLevel() {
        $this->Level++;
        $this->Damage *= $this->Level;
        if ($this->Level > 3) {
            $this->SwordLength = "medium";
            if ($this->Level > 5) {
                $this->SwordLength = "long";
            }
        }
    }

    public function updateWarrior($conn) {
        $sql = "UPDATE swordsman
        SET Damage = $this->Damage, Life = $this->Life, Level = $this->Level, SwordLength = '$this->SwordLength'
        WHERE Id = $this->Id";
        $conn->connectData($sql);
    }

    public function saveWarrior($conn) {
        $sql = "INSERT INTO swordsman (Name, Damage, Life, Level, SwordLength) 
        VALUES ('$this->Name', $this->Damage, $this->Life, $this->Level, '$this->SwordLength')";
        $conn->connectData($sql);
        return "Swordsman warrior added to yor battle war";
    }
}

?>
