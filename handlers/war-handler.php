<?php

class WarHandler {
    public static function saveWar($conn, $warName, $warDate) {
        $sql = "INSERT INTO war (Name, Date) VALUES ('$warName', '$warDate')";
        $conn->connectData($sql);
        return $conn->getId();
    }

    public static function getWarByName($conn, $warName) {
        $sql = "SELECT * From war WHERE Name = '$warName'";
        return $conn->getFullData($sql, "War");
    }

    public static function setWarriorsToWar($conn, $arr, $typeWarrior, $warId) {
        foreach ($arr as $key => $value) {
            $typeWarriorId = $value;
            $sql = "SELECT * FROM $typeWarrior WHERE Id = $typeWarriorId";
            $result = $conn->getSingleData($sql, $typeWarrior);
            if ($result) {   
                $warriors[] = $result;
                $sql = "INSERT INTO warrior (WarId, WarriorId, Type) VALUES ('$warId', '$typeWarriorId', '$typeWarrior')";
                $conn->connectData($sql);
            }
        }
        return $warriors;
    }

    public static function getWarriorsById($conn, $WarId) {
        $archerArr = $axemanArr = $swordsmanArr = array();
        $archerArr    = self::getWarriorsByType($conn, $WarId, "archer", "NumberOfArrows");
        $axemanArr    = self::getWarriorsByType($conn, $WarId, "axeman", "AxeSize");
        $swordsmanArr = self::getWarriorsByType($conn, $WarId, "swordsman", "SwordLength");
        $warriorsWar = array_merge($axemanArr, $swordsmanArr, $archerArr);
        return $warriorsWar;
    }

    public static function getWarriorsByType($conn, $WarId, $type, $weapon) {
        $sql =
        "SELECT warrior.Type AS Type, $type.Id AS Id, $type.Name AS Name, $type.Damage as Damage, $type.Life as Life, $type.Level as Level, $type.$weapon as Weapon FROM warrior
        JOIN $type ON warrior.WarriorId = $type.Id
        AND warrior.Type = '$type'
        WHERE warrior.WarId = $WarId";
        $result = $conn->getFullData($sql);
        if ($result) {
            return $result;
        } else {
            return [];
        }
    }

    public static function getWarsFinally($conn) {
        $sql = "SELECT * FROM war ORDER BY Id DESC";
        $result = $conn->getFullData($sql);

        if ($result) {
            foreach ($result as $value) {
                $warId = $value->Id;
                echo
                "<div class='jumbotron bg-dark text-light p-3 text-center'>
                    <h3>".strtoupper($value->Name)."</h3>
                    <p>$value->Date</p>
                </div>
                <table class='table table-hovered table-striped table-hover table-responsive text-center'>
                    <thead>
                        <tr>
                            <th class='text-center'>Warrior</th>
                            <th class='text-center'>Name</th>
                            <th class='text-center'>Weapon</th>
                            <th class='text-center'>Damage</th>
                            <th class='text-center'>Life</th>
                            <th class='text-center'>Level</th>
                        </tr>
                    </thead>
                    <tbody";
                    $warriorsWar = self::getWarriorsById($conn, $warId);
                    if ($warriorsWar) {
                        foreach ($warriorsWar as $warrior) {
                            echo
                            "<tr>
                                <td>".ucfirst($warrior->Type)."</td>
                                <td>".ucfirst($warrior->Name)."</td>
                                <td>".ucfirst($warrior->Weapon)."</td>
                                <td>$warrior->Damage</td>
                                <td>$warrior->Life</td>
                                <td>$warrior->Level</td>
                            </tr>";
                        }
                    }
                    echo
                    "</tbody>
                </table>";
            }
        } else {
            echo
            "<div class='jumbotron bg-danger text-light p-3 text-center'>
                <h3><i class='fa fa-exclamation-circle mr-2'></i>You have empty wars</h3>
            </div>";
        }
    }

    public static function searchWars($conn) {
        if (isset($_GET["search"])) {
            if (!empty($_GET["warNameSearch"])) {
                $table = "";
                $warName = $_GET["warNameSearch"];
                $wars = self::getWarByName($conn, $warName);
                if ($wars) {
                    $msg =
                    "<div class='col-md-12 mt-5'>
                        <div class='jumbotron bg-success text-light p-3 text-center'>
                            <h3><i class='fa fa-check-circle-o mr-2'></i>Matches found</h3>
                        </div>
                    </div>";
                    foreach ($wars as $value) {
                        $warId = $value->Id;
                        $table .=
                        "<div class='col-md-12'>
                            <div class='jumbotron bg-dark text-light p-3 text-center'>
                                <h3>".strtoupper($value->Name)."</h3>
                                <p>$value->Date</p>
                            </div>
                        </div>
                        <table class='table table-hovered table-striped table-hover table-responsive text-center'>
                            <thead>
                                <tr>
                                    <th class='text-center'>Warrior</th>
                                    <th class='text-center'>Name</th>
                                    <th class='text-center'>Weapon</th>
                                    <th class='text-center'>Damage</th>
                                    <th class='text-center'>Life</th>
                                    <th class='text-center'>Level</th>
                                </tr>
                            </thead>
                            <tbody";
                            $warriorsWar = self::getWarriorsById($conn, $warId);
                            if ($warriorsWar) {
                                foreach ($warriorsWar as $warrior) {
                                    $table .=
                                    "<tr>
                                        <td>".ucfirst($warrior->Type)."</td>
                                        <td>".ucfirst($warrior->Name)."</td>
                                        <td>".ucfirst($warrior->Weapon)."</td>
                                        <td>$warrior->Damage</td>
                                        <td>$warrior->Life</td>
                                        <td>$warrior->Level</td>
                                    </tr>";
                                }
                            }
                            $table .=
                            "</tbody>
                        </table>";
                    }

                    return $msg . $table;
                } else {
                    return
                    "<div class='col-md-12 mt-5'>
                        <div class='jumbotron bg-warning text-light p-3 text-center'>
                            <h3><i class='fa fa-exclamation-circle mr-2'></i>No matches found</h3>
                        </div>
                    </div>";
                }
            }
        }
    }

    public static function setNewWarrior($conn) {
        if (isset($_POST["addArcher"])) {
            $archerName = $_POST["archerName"];
            $archer = new archer(0, $archerName, 50, 100, 1, "10 arrows");
            return $archer->saveWarrior($conn);
        }
        
        if (isset($_POST["addAxeman"])) {
            $axemanName = $_POST["axemanName"];
            $axeman = new axeman(0, $axemanName, 50, 100, 1, "small");
            return $axeman->saveWarrior($conn);
        }
        
        if (isset($_POST["addSwordsman"])) {
            $swordsmanName = $_POST["swordsmanName"];
            $swordsman = new swordsman(0, $swordsmanName, 50, 100, 1, "short");
            return $swordsman->saveWarrior($conn);
        }
    }

    public static function warriorsTable($conn) {
        $table = "";
        // Archer
        $sql = "SELECT * FROM archer";
        $result = $conn->getFullData($sql, "Archer");
        if ($result) {
            foreach ($result as $value) {
                $table .=
                "<tr>
                    <td>Archer</td>
                    <td>".ucfirst($value->getName())."</td>
                    <td>".ucwords($value->NumberOfArrows)."</td>
                    <td>$value->Damage</td>
                    <td>$value->Life</td>
                    <td>$value->Level</td>
                    <td><input type='checkbox' class='css-checkbox' name='archerCb[]' id='archer{$value->getId()}' value='{$value->getId()}'><label for='archer{$value->getId()}' class='css-label'></label></td>
                </tr>";
            }
        }
        // Axeman 
        $sql = "SELECT * FROM axeman";
        $result = $conn->getFullData($sql, "Axeman");
        if ($result ) {
            foreach ($result as $value) {
                $table .=
                "<tr>
                    <td>Axeman</td>
                    <td>".ucfirst($value->getName())."</td>
                    <td>".ucfirst($value->AxeSize)."</td>
                    <td>$value->Damage</td>
                    <td>$value->Life</td>
                    <td>$value->Level</td>
                    <td><input type='checkbox' class='css-checkbox' name='axemanCb[]' id='axeman{$value->getId()}' value='{$value->getId()}'><label for='axeman{$value->getId()}' class='css-label'></label></td>
                </tr>";
            }         
        }
        // Swordsman
        $sql = "SELECT * FROM swordsman";
        $result = $conn->getFullData($sql, "Swordsman");
        if ($result ) {
            foreach ($result as $value) {
                $table .=
                "<tr>
                    <td>Swordsman</td>
                    <td>".ucfirst($value->getName())."</td>
                    <td>".ucfirst($value->SwordLength)."</td>
                    <td>$value->Damage</td>
                    <td>$value->Life</td>
                    <td>$value->Level</td>
                    <td><input type='checkbox' class='css-checkbox' name='swordsmanCb[]' id='swordsman{$value->getId()}' value='{$value->getId()}'><label for='swordsman{$value->getId()}' class='css-label'></label></td>
                </tr>";
            }    
        }
        
        if (!empty($table)) {
            return
            "<div class='row justify-content-center'>
                <div class='col-md-12'>
                    <table class='table table-hovered table-striped table-hover table-responsive text-center'>
                        <thead>
                            <tr>
                                <th class='text-center'>Warrior</th>
                                <th class='text-center'>Name</th>
                                <th class='text-center'>Weapon</th>
                                <th class='text-center'>Damage</th>
                                <th class='text-center'>Life</th>
                                <th class='text-center'>Level</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>" . $table .
                        "</tbody>
                    </table>
                </div>
            </div>
            <div class='row justify-content-center'>
                <div class='col-md-12'>
                    <div class='form-group'>
                        <input type='text' name='warName' id='warName' class='form-control' placeholder='War Name' required>
                    </div>
                    <div class='form-group'>
                        <input type='submit' value='Create Battle' name='battle' class='btn btn-primary form-control'>
                    </div>
                </div>
            </div>";
        } else {
            return
            "<div class='jumbotron bg-danger text-light p-3 text-center'>
                <h3><i class='fa fa-exclamation-circle mr-2'></i>You have empty warriors</h3>
            </div>";
        }
    }

    public static function warriorsAttack($conn) {
        $archerArr = $axemanArr = $swordsmanArr = array();

        if (isset($_POST["battle"])) {
            if (isset($_POST["warName"]) && !empty($_POST["warName"]) && !empty($_POST["archerCb"]) || !empty($_POST["axemanCb"]) || !empty($_POST["swordsmanCb"])) {
                $warName = $_POST["warName"];
                $warDate = date("d-m-Y");
                $warId   = self::saveWar($conn, $warName, $warDate);

                if (!empty($_POST["archerCb"])) {
                    $archerArr = self::setWarriorsToWar($conn, $_POST["archerCb"], "archer", $warId);
                }
            
                if (!empty($_POST["axemanCb"])) {
                    $axemanArr = self::setWarriorsToWar($conn, $_POST["axemanCb"], "axeman", $warId);
                }
            
                if (!empty($_POST["swordsmanCb"])) {
                    $swordsmanArr = self::setWarriorsToWar($conn, $_POST["swordsmanCb"], "swordsman", $warId);
                }

                $warriors = array_merge($archerArr, $axemanArr, $swordsmanArr);

                if (!empty($warriors)) {
                    $war = new War($warId, $warName, $warDate, $warriors);
                    $war->attackWarriors($conn);
                }  
            } else {
                return
                "<div class='jumbotron bg-danger text-light p-3 text-center'>
                    <h3><i class='fa fa-exclamation-circle mr-2'></i>Select at least one warrior</h3>
                </div>";
            }
        }
    }
}

?>
