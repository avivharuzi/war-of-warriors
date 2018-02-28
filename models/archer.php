<?php

class Archer extends Warrior {
    public $NumberOfArrows;

    public function __construct() {
    	if (func_num_args() > 0) {
            $_id     = func_get_arg(0);
            $_name   = func_get_arg(1);
            $_damage = func_get_arg(2);
            $_life   = func_get_arg(3);
            $_level  = func_get_arg(4);
            parent::__construct($_id, $_name, $_damage, $_life, $_level);
      		$this->NumberOfArrows = func_get_arg(5);
    	}
  	}

    public function attack() {        
        echo ucfirst($this->Name) . " attacks with $this->NumberOfArrows arrows, damage: $this->Damage";
        $this->Life -= $this->Level;
    }

    public function upgradeLevel() {
        $this->Level++;
        $this->Damage *= $this->Level;
        if ($this->Level > 3) {
            $this->NumberOfArrows = "15 arrows";
            if ($this->Level > 5) {
                $this->NumberOfArrows = "20 arrows";
            }
        }
    }    

    public function updateWarrior($conn) {
        $sql = "UPDATE archer
        SET Damage = $this->Damage, Life = $this->Life, level = $this->Level, NumberOfArrows = '$this->NumberOfArrows'
        WHERE Id = $this->Id";
        $conn->connectData($sql);
    }

    public function saveWarrior($conn) {
        $sql = "INSERT INTO archer (Name, Damage, Life, Level, NumberOfArrows) 
        VALUES ('$this->Name', $this->Damage, $this->Life, $this->Level, '$this->NumberOfArrows')";
        $conn->connectData($sql);
        return "Archer warrior added to yor battle war";
    }
}

?>
