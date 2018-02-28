<?php

class War {
    public $Id;
    public $Name;
    public $Date;
    public $Warriors;

    public function __construct() {
        if (func_num_args() > 0) {
            $this->Id       = func_get_arg(0);
            $this->Name     = func_get_arg(1);
            $this->Date     = func_get_arg(2);
            $this->Warriors = func_get_arg(3);
        }
    }

    final public function attackWarriors($conn) {
        echo 
        "<div class='alert alert-success text-center'>";
        foreach ($this->Warriors as $value) {
            echo "<p class='lead'>" . $value->attack() . "</p>";
            $value->upgradeLevel();
            $value->updateWarrior($conn);
        }
        echo "</div>";
    }
}

?>
