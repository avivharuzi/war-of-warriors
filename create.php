<?php

require_once("auth/config.php");

$title = "Create";

?>

<?php require_once("layout/header.php"); ?>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6" id="form-create">
            <?php
            $msg = WarHandler::setNewWarrior($conn);
            
            if (!empty($msg)) {
                echo
                "<div class='alert alert-success text-center'>
                    <p class='lead'><i class='fa fa-check-circle-o mr-2'></i>$msg</p>
                </div>";
            }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" autocomplete="off">
                <div class="form-group">
                    <input type="text" name="archerName" id="archerName" class="form-control" placeholder="Warrior Name">
                </div>
                <div class="form-group">
                    <input type="submit" value="Add Archer" name="addArcher" class="btn btn-success form-control">
                </div>
            </form>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" autocomplete="off">
                <div class="form-group">
                    <input type="text" name="axemanName" id="axemanName" class="form-control" placeholder="Warrior Name">
                </div>
                <div class="form-group">
                    <input type="submit" value="Add Axeman" name="addAxeman" class="btn btn-warning text-light form-control">
                </div>
            </form>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" autocomplete="off">
                <div class="form-group">
                    <input type="text" name="swordsmanName" id="swordsmanName" class="form-control" placeholder="Warrior Name">
                </div>
                <div class="form-group">
                    <input type="submit" value="Add Swordsman" name="addSwordsman" class="btn btn-danger form-control">
                </div>
            </form>
        </div>
        <div class="col-md-6 text-center">
            <img src="assets/images/main/warrior.svg" alt="warrior" style="width:400px;height:auto;">
        </div>
    </div>
</div>
<?php require_once("layout/footer.php"); ?>
