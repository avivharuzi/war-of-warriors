<?php

require_once("auth/config.php");

$title = "Battle";

?>

<?php require_once("layout/header.php"); ?>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-12">
        <?php
        echo WarHandler::warriorsAttack($conn);
        ?>
        </div>
        <div class="col-md-12" id="form-create">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" autocomplete="off">
                <?php
                echo WarHandler::warriorsTable($conn);
                ?>
            </form>
        </div>
    </div>
</div>
<?php require_once("layout/footer.php"); ?>
